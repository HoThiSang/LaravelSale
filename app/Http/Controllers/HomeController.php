<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('index', compact('products'));
    }

    public function showCart()
    {
        $products = Products::take(3)->get();
        return view('checkout', compact('products'));
        //     $products = Products::all();
        //     return view('checkout', compact('products'));
        //     // return view('checkout');
    }

    public function login()
    {
        return view('login');
    }
}
