@extends('layout.master');

@section('content');

<div id="alert"></div>
<?php // dd($productCarts)
$totalPrice = 0;
?>
<div class="container">
    <div id="content">
        @if($check==true)
        <div class="table-responsive">
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">ID</th>
                        <th class="product-price">Note</th>
                        <th class="product-status">Payment</th>
                        <th class="product-quantity">Order date</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customerBills as $bill)
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ $bill->id  }}
                        </td>
                        <td class="product-price">
                            {{ $bill->note  }}
                        </td>


                        <td class="product-status">
                            {{ $bill->payment  }}
                        </td>

                        <td class="product-quantity">
                            {{ $bill->created_at  }}
                        </td>

                        <td class="product-subtotal">

                            <span class="amount">{{ $bill->total  }}</span>


                        </td>

                        <td class="product-remove">
                            <a href="" class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div>You are not have bill</div>
        @endif

    </div>
</div>

@endsection