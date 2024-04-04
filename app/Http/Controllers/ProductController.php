<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductType;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $products;


    public function __construct()
    {
        $this->products = new Products();
    }
    public function index()
    {
        $products = Products::all();
        return view('pages/car-list', compact('products'));
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
        return view('pages/show', ['product' => $product, 'title' => $title]);
    }

    public function showPricing()
    {
        return view('pages/pricing');
    }

    public function showProductType($id)
    {

        $products = $this->products->getAllProductType($id);
        // dd($products);
        return view('pages/product-type', compact('products'));
    }
}
