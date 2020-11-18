<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    public function index()
    {
        return view('Client.home');
    }

    public function shop()
    {
        $all_products=DB::table('tbl_products')
					->where('status',1)
					->get();
        return view('Client.shop')->with('all_products',$all_products);
    }


    public function checkout()
    {
        return view('Client.checkout');
    }
    
}
