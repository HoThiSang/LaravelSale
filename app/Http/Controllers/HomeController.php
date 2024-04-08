<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('pages/index', compact('products'));
    }

    public function showCart()
    {
        $products = Products::take(3)->get();
        return view('pages/checkout', compact('products'));
       
    }

    public function login()
    {
        return view('pages/login');
    }

    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact');
    }
}
