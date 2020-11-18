<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
class CategoryController extends Controller
{
    public function save_category(Request $request)
    {
        $data=array();
        $data['category_name']=$request->category_name;

        DB::table('tbl_category')->insert($data);

        Session::put('message','The category is added successfully');

        return redirect::to('/add_category');
    }

    public function delete_category($id)
    {
        DB::table('tbl_category')
            ->where('id',$id)
            ->delete();

        Session::put('message','Category is deleted successfully');

        return redirect::to('/categories');
    }

    public function edit_category($id)
    {
        $select_category=DB::table('tbl_category')
                            ->where('id',$id)
                            ->first();

        Session::put('category_name',$select_category->category_name);
        return view('admin.edit_category')->with('select_category',$select_category);
    }

    public function update_category(Request $request)
    {

        $data=array();
        $data['category_name']=$request->category_name;

        $data1=array();
        $data1['product_category']=$request->category_name;

        $id=$request->category_id;

        DB::table('tbl_products')
            ->where('product_category',Session::get('category_name'))
            ->update($data1);

        $select_category=DB::table('tbl_category')
                            ->where('id',$id)
                            ->update($data);

        Session::put('message','The category is updated successfully');

         return redirect::to('/categories');
    }
}
