@extends('layout.master');
@section('banner')

@endsection
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>New Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">438 styles found</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($products as $product)
                            @if(($product->new)==1)
                            <div class="col-sm-3" style="margin-bottom:50px">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="{{ route('detail', ['id' => $product['id']]) }}">
                                            <img src="/source/image/product/{{ $product['image'] }}" alt="" width="180px" height="180px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $product->name }}</p>
                                        @if( ($product->promotion_price)!=0)
                                        <p class="single-item-price">
                                            <span class="flash-del">{{ number_format( $product->unit_price,0,",",",")}}</span>
                                            <span class="flash-sale">{{ number_format( $product->promotion_price,0,",",",")}}</span>
                                        </p>
                                        @else
                                        <p class="single-item-price">
                                            <span class="flash-del">{{ number_format( $product->unit_price,0,",",",")}}</span>
                                        </p>
                                        @endif
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{ route('detail', ['id' => $product['id']]) }}">
                                            Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>All Products</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">438 styles found</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($products as $product)
                            @if(($product->new)==1)
                            <div class="col-sm-3" style="margin-bottom: 50px">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="{{ route('detail', ['id' => $product['id']]) }}">
                                            <img src="/source/image/product/{{ $product['image'] }}" alt="" width="180px" height="180px">
                                        </a>
                                    </div>
                                    <div class=" single-item-body">
                                        <p class="single-item-title">{{ $product->name }}</p>
                                        @if( ($product->promotion_price)!=0)
                                        <p class="single-item-price">
                                            <span class="flash-del">{{ number_format( $product->unit_price,0,",",".")}}</span>
                                            <span class="flash-sale">{{ number_format( $product->promotion_price,0,",",".")}}</span>
                                        </p>
                                        @else
                                        <p class="single-item-price">
                                            <span class="flash-del">{{ $product->unit_price }}</span>
                                        </p>
                                        @endif
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{ route('detail', ['id' => $product['id']]) }}">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="space40">&nbsp;</div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection