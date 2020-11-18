<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cart;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function save_product(Request $request) 
    {
        if ($request->product_category=='Select category') {
            Session::put('message1','Please select the category');

            return redirect::to('/add_product');
        } else {

            $this->validate($request,[
                'product_image'=>'image|nullable|max:1999'
            ]);

            if($request->hasFile('product_image')){

                //1: Get file name with extension
                $filenameWithExt=$request->file('product_image')->getClientOriginalName();
                //2: Get just file name 
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                //3: Get only the extension
                $extension=$request->file('product_image')->getClientOriginalExtension();
                //4: File name to store
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                //5: Store
                $path=$request->file('product_image')->storeAs('public/cover_image',$fileNameToStore);
            }
            else
            {
                $fileNameToStore='noimage.png';
            }

            $data=array();
            $data['product_name']=$request->product_name;
            $data['product_price']=$request->product_price;
            $data['product_category']=$request->product_category;
            $data['product_image']=$fileNameToStore;
            $data['status']=$request->product_status;

            DB::table('tbl_products')->insert($data);

            Session::put('message','The product is added successfully');

            return redirect::to('/add_product');
        }

    }

    public function select_product_by_category($category_name)
    {
            $all_products=DB::table('tbl_products')
                    ->where('product_category',$category_name)
					->where('status',1)
					->get();
            return view('Client.shop')->with('all_products',$all_products);
    }

    public function unactivate_product($id)
    {
        $data=array();
        $data['status']=0;

        DB::table('tbl_products')
            ->where('id',$id)
            ->update($data);

        Session::put('message','Product is unactivated successfully');

        return redirect::to('/products');
    }

    public function activate_product($id)
    {
        $data=array();
        $data['status']=1;
        
        DB::table('tbl_products')
            ->where('id',$id)
            ->update($data);

        Session::put('message','Product is activated successfully');

        return redirect::to('/products');
    }

    public function delete_product($id)
    {
        DB::table('tbl_products')
            ->where('id',$id)
            ->delete();

        Session::put('message','Product is deleted successfully');

        return redirect::to('/products');
    }

    public function edit_product($id)
    {
        $select_products=DB::table('tbl_products')
                            ->where('id',$id)
                            ->first();

        return view('admin.edit_product')->with('select_products',$select_products);
    }

    public function update_product(Request $request)
    {
        $this->validate($request,[
            'product_image'=>'image|nullable|max:1999'
        ]);

        $data=array();

        if($request->hasFile('product_image')){

            //1: Get file name with extension
            $filenameWithExt=$request->file('product_image')->getClientOriginalName();
            //2: Get just file name 
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //3: Get only the extension
            $extension=$request->file('product_image')->getClientOriginalExtension();
            //4: File name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //5: Store
            $path=$request->file('product_image')->storeAs('public/cover_image',$fileNameToStore);

            $select_image=DB::table('tbl_products')
                            ->where('id',$request->product_id)
                            ->first();
            
            $data['product_image']=$fileNameToStore;

            if($select_image->product_image != 'noimage.png'){
                Storage::delete('public/cover_image/'.$select_image->product_image);
            }
        }

        $data['product_name']=$request->product_name;
        $data['product_price']=$request->product_price;
        $data['product_category']=$request->product_category;

        DB::table('tbl_products')
            ->where('id',$request->product_id)
            ->update($data);

        Session::put('message','The product is updated successfully');

        return redirect::to('/products');
    }

    public function addToCart($id)
    {
        $product=DB::table('tbl_products')
                    ->where('id',$id)
                    ->first();

        $oldcart=Session::has('cart')? Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->add($product,$id);
        Session::put('cart',$cart);

        //dd(Session::get('cart'));
        return redirect::to('/shop');
    }

    public function cart()
    {
        if(!Session::has('cart')){
            return view('Client.cart');
        }
        
        
        
        $oldcart=Session::has('cart')? Session::get('cart'):null;
        $cart=new Cart($oldcart);
        return view('Client.cart',['products'=>$cart->items]);
    }

    public function updateQty(Request $request)
    {
        $oldcart=Session::has('cart')? Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->updateQty($request->id,$request->quantity);
        Session::put('cart',$cart);

        return redirect::to('/cart');
    }

    public function removeItem($id)
    {
        $oldcart=Session::has('cart')? Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }

        return redirect::to('/cart');
    }

    public function checkout()
    {
        if(!Session::has('cart')){
            return view('Client.cart');
        }
        
        
        
        $oldcart=Session::has('cart')? Session::get('cart'):null;
        $cart=new Cart($oldcart);
        return view('Client.checkout',['totalPrice'=>$cart->totalPrice]);
    }

    public function postCheckout(Request $request)
    {
        if(!Session::has('cart')){
            return redirect::to('/cart'); 
            // , ['Products' => null]           
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_SswshKo8F9ufxzo0N3mb0MVz001jopBbkD');
        
        try{
            $charge=Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));

            $data=array();
            $data['name']=$request->name;
            $data['adress']=$request->adresse;
            $data['cart']=serialize($cart);
            $data['payment_id']=$charge->id;

            DB::table('tbl_orders')
                ->insert($data);
                
        } catch(\Exception $e){
            Session::put('error', $e->getMessage());
            return redirect::to('/checkout');
        }

        Session::forget('cart');
        Session::put('success', 'Purchase accomplished successfully !');
        return redirect::to('/');
    }

    public function orders()
    {
        return view('admin.display_orders');
    }
}
