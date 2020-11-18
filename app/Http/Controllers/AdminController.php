<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function add_category()
    {
        return view('admin.add_category');
    }

    public function add_product()
    {
        return view('admin.add_product');
    }

    public function add_slider()
    {
        return view('admin.add_slider');
    }

    public function categories()
    {
        return view('admin.all_categories');
    }

    public function products()
    {
        return view('admin.all_products');
    }

    public function sliders()
    {
        return view('admin.all_sliders');
    }

    
}
