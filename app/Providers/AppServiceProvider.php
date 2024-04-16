<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductType;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { // Cách 1 : share cho toàn bộ trang 
        View::share('productTypes', ProductType::all());
        
        /* Cách 2 : Share cho trang cụ thể : 
        Facades\View::composer('layout.header', 'product-type', function (View $view) {
            $productTypes = ProductType::all());
        });
        */
      //chia sẻ biến Session('cart') cho các view header.blade.php và checkout.php
        View::composer(['components.header','pages.checkout', 'pages.shopping-cart'],function($view){
            if(Session('cart')){
                $oldCart=Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'productCarts'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
    }
}
