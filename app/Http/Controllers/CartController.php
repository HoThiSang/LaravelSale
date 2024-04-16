<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public $cart;

    public function addToCart(Request $request, $id)
    {
        if (Auth()->check()) {
        $product = Products::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Add to cart successfully');
        }
        return redirect()->back()->with('error', 'Add to cart failed !');
    }


    public function deleteCart(Request $request, $id)
    {
        if (Auth()->check()) {
        $product = Products::find($id);
        if ($product) {
            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $cart->removeItem($id);

                // Kiểm tra xem mục đã được xóa thành công hay không
                if ($cart->items && count($cart->items) > 0) {
                    Session::put('cart', $cart);
                    return redirect()->back()->with('message', 'Delete item from your cart successfully');
                } else {
                    Session::forget('cart');
                    return redirect()->back()->with('error', 'Cannot delete item from your cart successfully');
                }
            } else {
                return redirect()->back()->with('error', 'No items in your cart');
            }
        } else {
            return redirect()->back()->with('error', 'No items in your cart');
        }
    }
    }


    public function checkout(Request $request)
    {
        if (Auth()->check()) {


            if (Session::has('cart')) {
                $cart =   Session::get('cart');

                if ($request->isMethod('post')) {

                    $rules = [
                        'user_name' => 'required',
                        'gender' => 'required',
                        'email' => 'required|email|regex:/^.+@.+$/i',
                        'phone' => 'required|regex:/^\d{10}$/',
                        'address' => 'required',
                    ];
                    $messages = [
                        'email.required' => 'The email field is must required',
                        'email.regex' => 'Invalid email format.',
                        'phone.required' => 'The phone field is must required',
                        'phone.regex' => 'Phone number must be 10 digits.',
                        'address.required' => 'The address field is must required'
                    ];

                    $validateData = Validator::make($request->all(), $rules, $messages);

                    if ($validateData->fails()) {
                        return redirect()->back()->withErrors($validateData);
                    } else {
                        if ($request->payment_method == 'COD') {
                            $customer_id = $request->customer_id;
                        } else {
                        }
                    }
                }
            }
        }
    }


    public function showCart()
    {

        return view('pages/shopping-cart');
    }

    public function getCheckout()
    {
        $check = false;
        if (Auth()->check()) {
            $check = true;
            return view('pages/checkout', compact('check'));
        }
        return view('pages/checkout', compact('check'));
    }


    public function updateCart(Request $request, $id)
    {
        if (Auth()->check()) {


            if (!$id) {
                return redirect()->back()->with('error', 'Invalid product id');
            }

            $oldCart = session()->has('cart') ? session()->get('cart') : null;
            $cart = new Cart($oldCart);

            if (!$cart->items || !array_key_exists($id, $cart->items)) {
                return redirect()->back()->with('error', 'Product not found in cart');
            }

            $newQuantity = $request->input('quantity');

            if (!is_numeric($newQuantity) || $newQuantity <= 0) {
                return redirect()->back()->with('error', 'Invalid quantity');
            }

            $cart->updateProduct($id, $newQuantity);

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully');
        }
    }
}
