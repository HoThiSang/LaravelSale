@extends('layout.master')

@section('content')
@if(Session::has('cart'))
<div id="alert"></div>
<?php // dd($productCarts)
$totalPrice = 0;
// dd($customer);
?>
<div class="container">
    <div id="content">

        <form action="{{ route('checkout') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <h4>Đặt hàng</h4>
                    <div class="space20">&nbsp;</div>
                    <input type="hidden" name="customer_id" value="{{ $customer->id ?? '' }}">
                    <div class="form-block">
                        <label for="name">Họ tên*</label>
                        <input type="text" id="user_name" name="user_name" value="{{ $customer->name ?? '' }}" placeholder="Họ tên">
                        @error('user_name')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-block">
                        <label>Giới tính </label>
                        <input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                        <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>

                    </div>

                    <div class="form-block">
                        <label for="email">Email*</label>
                        <input type="email" id="email" name="email" value="{{ $customer->email ?? '' }}" placeholder="expample@gmail.com">
                        @error('email')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-block">
                        <label for="adress">Địa chỉ*</label>
                        <input type="text" id="address" name="address" value="{{ $customer->address ?? '' }}" placeholder="Street Address">
                        @error('address')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-block">
                        <label for="phone">Điện thoại*</label>
                        <input type="text" id="phone" name="phone" value="{{ $customer->phone_number ?? '' }}" placeholder="Phone number">
                        @error('phone')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-block">
                        <label for="notes">Ghi chú</label>
                        <textarea id="notes" name="note">{{ $customer->note ?? '' }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head">
                            <h5>Đơn hàng của bạn</h5>
                        </div>
                        <div class="your-order-body" style="padding: 0px 10px">
                            @foreach($productCarts as $product)

                            <div class="your-order-item">
                                <div>
                                    <div class="media">
                                        <img width="25%" src="/source/image/product/{{ $product['item']['image'] }}" alt="" class="pull-left">
                                        <div class="media-body">
                                            <p class="font-large">{{ $product['item']['name'] }}</p>
                                            @if($product['item']['promotion_price']==0)
                                            <span class="color-gray your-order-info">Price: {{ number_format($product['item']['unit_price']) }}</span>

                                            @else
                                            <span class="color-gray your-order-info">Promotion price: {{ number_format($product['item']['promotion_price']) }}</span>
                                            @endif
                                            <span class="color-gray your-order-info">{{ $product['qty'] }}</span>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}">
                                        <input type="hidden" name="product_id" value="{{ $product['item']['quantity'] }}">
                                        <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}">
                                        <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}">
                                        <input type="hidden" name="product_id" value="{{ $product['item']['id'] }}">
                                        <?php if ($product['item']['promotion_price'] == 0) {
                                            $totalPrice += $product['qty'] * $product['item']['unit_price']; // Nếu không có giá khuyến mãi
                                        } else {
                                            $totalPrice += $product['qty'] * $product['item']['promotion_price']; // Nếu có giá khuyến mãi
                                        } ?>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            @endforeach
                            <div class="your-order-item">
                                <div class="pull-left">
                                    <p class="your-order-f18">Tổng tiền:</p>
                                </div>
                                <div class="pull-right">
                                    <h5 class="color-black">{{ $totalPrice}}</h5>
                                    <input type="hidden" value="{{ $totalPrice }}" name="totalPrice">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="your-order-head">
                            <h5>Hình thức thanh toán</h5>
                        </div>

                        <div class="your-order-body">
                            <select name="payment_method" id="">Payment meyhod
                                <option value="COD">Thanh toán khi giao hàng</option>
                                <option value="VNPAY">Thanh toán bằng VNP</option>
                            </select>
                        </div>
                        <div class="text-center"><button type="submit" name="redirect">Đặt hàng</button></div>
                    </div> <!-- .your-order -->
                </div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endif
@endsection