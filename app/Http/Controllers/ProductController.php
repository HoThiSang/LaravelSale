<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('car-list', compact('products'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
        $title = "Product";
        $product = Products::find($id);
        // dd($car);
        return view('show', ['product' => $product, 'title' => $title]);
    }

    public function showPricing()
    {
        return view('pricing');
    }

    public function showProductType($id)
    {

        $products = Products::where('id_type', $id)->get();

        return view('product-type', compact('products'));
    }
}
