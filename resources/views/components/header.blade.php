   <div id="header">
       <div class="header-top">
           <div class="container">
               <div class="pull-left auto-width-left">
                   <ul class="top-menu menu-beta l-inline">
                       <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                       <li><a href="#"><i class="fa fa-sitemap"></i> Sitemap</a></li>
                   </ul>
               </div>
               <div class="pull-right auto-width-right">
                   <ul class="top-details menu-beta l-inline">
                       <li><a href="{{route('login')}}"><i class="fa fa-user"></i> Sign in</a></li>
                       <li><a href="{{route('sign-up')}}"><i class="fa fa-user"></i> Sign up</a></li>
                       <li class="hidden-xs">
                           <select name="languages">
                               <option value="en">English</option>
                               <option value="ro">Romana</option>
                               <option value="ru">Rusa</option>
                           </select>
                       </li>
                       <li class="hidden-xs">
                           <select name="currency">
                               <option value="usd">USD</option>
                               <option value="eur">EUR</option>
                               <option value="ron">RON</option>
                           </select>
                       </li>
                   </ul>
               </div>
               <div class="clearfix"></div>
           </div> <!-- .container -->
       </div> <!-- .header-top -->
       <div class="header-body">
           <div class="container beta-relative">
               <div class="pull-left">
                   <a href="{{route('home')}}" id="logo"><img src="/source/assets/dest/images/logo-cake.png" width="120px" alt=""></a>
               </div>
               <div class="pull-right beta-components space-left ov">
                   <div class="space10">&nbsp;</div>
                   <div class="beta-comp">
                       <form role="search" method="get" id="searchform" action="/">
                           <input type="text" value="" name="s" id="s" placeholder="Search entire store here..." />
                           <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                       </form>
                   </div>
                   <?php $totalPrice = 0; ?>
                   <div class="beta-comp">
                       @if(Session::has('cart'))
                       <div class="cart">
                           <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (@if(Session::has('cart')){{ Session('cart')->totalQty }}
                               @else Trống @endif) <i class="fa fa-chevron-down"></i></div>

                           <div class="beta-dropdown cart-body">
                               @foreach($productCarts as $product)
                               <div class="cart-item">
                                   <a class="cart-item-delete" href="{{ route('delete-cart', ['id'=>$product['item']['id']])}}"><i class="fa fa-times"></i>
                                   </a>
                                   <div class="media">
                                       <a class="pull-left" href="#"><img src="/source/image/product/{{ $product['item']['image'] }}" alt=""></a>
                                       <div class="media-body">
                                           <span class="cart-item-title">{{ $product['item']['name'] }}</span>
                                           <span class="cart-item-amount">{{ $product['qty'] }}X <span>
                                                   @if($product['item']['promotion_price']==0)
                                                   {{ number_format($product['item']['unit_price']) }}
                                                   @else
                                                   {{ number_format($product['item']['promotion_price']) }}
                                                   @endif
                                                   <?php $totalPrice =   $totalPrice + $product['price']  ?>
                                               </span></span>
                                       </div>
                                   </div>
                               </div>
                               @endforeach

                               <div class="cart-caption">
                                   <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{ number_format($totalPrice) }}</span></div>
                                   <div class="clearfix"></div>

                                   <div class="center">
                                       <div class="space10">&nbsp;</div>
                                       <a href="{{ route('shopping-cart') }}" class="beta-btn primary text-center">Giỏ hàng <i class="fa fa-chevron-right"></i></a>
                                       <a href="{{ route('checkout-page') }}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                   </div>
                               </div>
                           </div>
                       </div> <!-- .cart -->
                       @endif
                   </div>


                   <!-- 
                                <div class="cart-item">
                                    <a class="cart-item-edit" href="#"><i class="fa fa-pencil"></i></a>
                                    <a class="cart-item-delete" href="#"><i class="fa fa-times"></i></a>
                                    <div class="media">
                                        <a class="pull-left" href="#"><img src="assets/dest/images/products/cart/2.png" alt=""></a>
                                        <div class="media-body">
                                            <span class="cart-item-title"></span>
                                            <span class="cart-item-options">Size: XS; Colar: Navy</span>
                                            <span class="cart-item-amount">1*<span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="cart-item">
                                    <a class="cart-item-edit" href="#"><i class="fa fa-pencil"></i></a>
                                    <a class="cart-item-delete" href="#"><i class="fa fa-times"></i></a>
                                    <div class="media">
                                        <a class="pull-left" href="#"><img src="assets/dest/images/products/cart/3.png" alt=""></a>
                                        <div class="media-body">
                                            <span class="cart-item-title"></span>
                                            <span class="cart-item-options">Size: XS; Colar: Navy</span>
                                            <span class="cart-item-amount">1*<span></span></span>
                                        </div>
                                    </div>
                                </div> -->

                   <!-- <div class="cart-caption">
                       <div class="cart-total text-right">Subtotal: <span class="cart-total-value">$34.55</span></div>
                       <div class="clearfix"></div>

                       <div class="center">
                           <div class="space10">&nbsp;</div>
                           <a href="{{ route('shopping-cart') }}" class="beta-btn primary text-center">Checkout<i class="fa fa-chevron-right"></i></a>
                       </div>
                   </div>
               </div>
           </div> 
       </div> -->
               </div>
               <div class="clearfix"></div>
           </div> <!-- .container -->
       </div> <!-- .header-body -->
       <div class="header-bottom" style="background-color: #0277b8;">
           <div class="container">
               <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
               <div class="visible-xs clearfix"></div>
               <nav class="main-menu">
                   <ul class="l-inline ov">
                       <li><a href="{{route('home')}}">Trang chủ</a></li>
                       <li><a href="#">Sản phẩm</a>
                           <ul class="sub-menu">
                               @if(isset($productTypes))
                               @foreach($productTypes as $productType)
                               <li id="1">
                                   <a href="{{ route('showProductType', ['id'=>$productType->id])}}">{{ $productType->name }}</a>
                               </li>
                               @endforeach
                               @endif

                           </ul>
                       </li>
                       <li><a href="{{ route('about-page') }}">Giới thiệu</a></li>
                       <li><a href="{{ route('contact-page') }}">Liên hệ</a></li>
                   </ul>
                   <div class="clearfix"></div>
               </nav>
           </div>
       </div>
   </div>



   @section('js')
   <script>
       var message = "{{ session('message') }}";
       var error = "{{ session('error') }}";

       if (message) {
           alert(message);
       } else if (error) {
           alert(error);
       }
   </script>
   @endsection