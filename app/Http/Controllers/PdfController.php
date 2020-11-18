<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cart;
use Illuminate\Support\Facades\Redirect;
use Session;

class PdfController extends Controller
{
    public function view_pdf($id)
    {
        Session::put('id',$id);
        try{
            $pdf=\App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
            $pdf->loadHTML($this->convert_orders_data_to_html());

            return $pdf->stream();
        }
        catch(\ Exception $e){
            return redirect::to('/orders')->with('error',$e->getMessage());
        }
    }

    public function convert_orders_data_to_html()
    {
        $orders=DB::table('tbl_orders')
                    ->where('id',Session::get('id'))
                    ->get();

        $name;
        $adresse;
        $totalPrice;

        foreach($orders as $order){
            $name=$order->name;
            $adresse=$order->adress;   
        }
        
        $orders->transform(function($order,$key){
            $order->cart=unserialize($order->cart);
            return $order;  
        });
                
        $output='<link rel="stylesheet" href="frontend/css/style.css">
                    <table class="table">
                                <thead class="thead">
                                    <tr class="text-left">
                                        <th>Client Name: '.$name.' <br> Client Adresse: '.$adresse.'</th>
                                    </tr>
                                </thead>
                        </table>
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Image</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach($orders as $order){
            foreach($order->cart->items as $item){
                $output.='<tr class="text-center">
                            <td class="image-prod"><img style="height:80px;width:80px" src="storage/cover_image/'.$item['product_image'].'"></td>
                            <td class="product-name">
                                <h3>'.$item['product_name'].'</h3>
                            </td>
                            <td class="price">$'.$item['product_price'].'</td>
                            <td class="qty">'.$item['qty'].'</td>
                            <td class="total">$'.$item['product_price']*$item['qty'].'</td>
                            </tr><!-- END TR-->';
            }
            $totalPrice=$order->cart->totalPrice;
        }

        $output.='</tbody></table>';
        $output.='<table class="table">
                        <thead class="thead">
                            <tr class="text-center">
                                    <th>Total</th>
                                    <th>$'.$totalPrice.'</th>
                            </tr>
                        </thead>
                </table>';
        
        return $output;
    }
}
