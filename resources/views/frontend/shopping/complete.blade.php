@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Checkout complete')
@section('description', 'Checkout complete')
@section('og:title', 'Checkout complete')
@section('og:description', 'Checkout complete')

@section('content')
<div class="container">
    <div class="wrapper check-out">
        <h1>Thanh toán</h1>
        <div class="processing">
            <ol id="progress-bar">
                <li class="info-icon ">1. Điền thông tin</li>
                <li class="pay-icon">2. Thanh toán</li>
                <li class="finish-icon step-active">3. Hoàn thành</li>
            </ol>
        </div>
        <div class="wrap-info">
            <div class="order-history">
                <h2 class="thank-pc">CẢM ƠN {{$order->name}} ĐÃ MUA SẮM CÙNG MIRI</h2>
                <h2 class="thank-mobile">CẢM ƠN {{$order->name}} </br> ĐÃ MUA SẮM CÙNG MIRI</h2>
                <div class="order-header">
                    <ul class="order-item-ul" id="scrollLeft">
                        <li class="history-id">Mã đơn hàng</li>
                        <li class="history-user">Người thanh toán</li>
                        <li class="history-date">Ngày thanh toán</li>
                        <li class="history-total">Tổng giá trị</li>
                        <li class="history-method">Hình thức thanh toán</li>
                    </ul>
                </div>
                <div class="order-body">
                    <div class="order-item">
                        <a class="accordion-toggle open" href="#">
                            <ul class="order-item-ul order-item-inner scrollAsWell">
                                <li class="history-id">{{$order->uuid}}</li>
                                <li class="history-user">{{$order->name}}</li>
                                <li class="history-date">{{date('d/m/Y', strtotime($order->order_date))}}</li>
                                <li class="history-total">{{number_format($order->total)}}VND</li>
                                <li class="history-method">{{$order->payment_type}}</li>
                            </ul>
                        </a>
                        <ul class="panel" style="display: block;">
                            @foreach ($order->detail as $item)
                            <li><a href="">
                                    <img src="{{$item->product->images->first()['picture']}}">
                                    <h3>{{$item->product_name}}</h3>
                                    <p class="money">{{number_format($item->price)}}VND<span class="qty"> X{{number_format($item->quantity)}}</span></p>
                                </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="button-group">
                    <a class="common-button" href="/">TIẾP TỤC MUA HÀNG</a>
                </div>
            </div>
        </div>
    </div>
    <!--End payment-method-->
</div>
@stop
