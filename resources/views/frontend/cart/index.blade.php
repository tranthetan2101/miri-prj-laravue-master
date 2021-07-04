@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Giỏ hàng')
@section('description', 'Giỏ hàng')
@section('og:title', 'Giỏ hàng')
@section('og:description', 'Giỏ hàng')

@section('content')
@if (!empty($cart) && count($cart->detail))
<div class="container">
    <div class="cart-page wrapper cart-page-detail">
        @include('frontend.cart.detail')
    </div>
    <!--End cart-page-->
    @include('frontend.cart.recommendProduct')
    <!--End favorite-product-->
</div>
@else
<div class="container">
    <div class="cart-page wrapper">
        <h1>Giỏ hàng của bạn</h1>
        <div class="cart-page-inner">
            <h2>khong co san pham</h2>
        </div>
    </div>
</div>
@endif
@stop