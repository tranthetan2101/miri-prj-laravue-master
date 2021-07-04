@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Checkout confirm')
@section('description', 'Checkout confirm')
@section('og:title', 'Checkout confirm')
@section('og:description', 'Checkout confirm')

@section('content')
<div class="container">
    <div class="wrapper check-out">
        <h1>Thanh toán</h1>
        <div class="processing">
            <ol id="progress-bar">
                <li class="info-icon step-active">1. Điền thông tin</li>
                <li class="pay-icon">2. Thanh toán</li>
                <li class="finish-icon">3. Hoàn thành</li>
            </ol>
        </div>
        <div class="wrap-info">
            <div class="delivery-info">
                <h2>VUI LÒNG KIỂM TRA ĐƠN HÀNG</h2>
                <form id='submit-form'>
                    <div class="confirm-info">
                        <p class="confirm-info-title">Thông tin khách hàng</p>
                        <p class="confirm confirm-email"><span>{{$order->email}}</span></p>
                        <p class="confirm confirm-user"><span>{{$order->name}}</span></p>
                        <p class="confirm confirm-phone"><span>{{$order->phone_number}}</span></p>
                        <p class="confirm confirm-address"><span>{{$order->addr_number}} {{ucwords($order->addr_street)}} {{$order->ward->type}} {{$order->ward->name}} {{$order->district->type}} {{$order->district->name}} {{$order->city->type}} {{$order->city->name}}</span></p>
                    </div>
                    @if (!empty($order->note))
                    <div class="confirm-info">
                        <p class="confirm-info-title">Lưu ý đơn hàng</p>
                        <p class="confirm confirm-local"><span>{{$order->note}}</span></p>
                    </div>
                    @endif
                    <div class="confirm-info">
                        <p class="confirm-info-title">Hình thức giao hàng</p>
                        <p class="confirm confirm-delivery"><span>giao hàng tiêu chuẩn (2-5 ngày)</span></p>
                    </div>
                    @if ($order->shipping)
                    <div class="confirm-info">
                        <p class="confirm-info-title">Giao hàng địa chỉ khác</p>
                        <p class="confirm confirm-local"><span>{{$order->shipping->addr_number}} {{ucwords($order->shipping->addr_street)}} {{$order->shipping->ward->type}} {{$order->shipping->ward->name}} {{$order->shipping->district->type}} {{$order->shipping->district->name}} {{$order->shipping->city->type}} {{$order->shipping->city->name}}</span></p>
                    </div>
                    @endif
                    @if ($order->receipt)
                    <div class="confirm-info">
                        <p class="confirm-info-title">Thông tin xuất hoá đơn</p>
                        <p class="confirm confirm-company"><span>{{$order->receipt->company_name}}</span></p>
                        <p class="confirm confirm-tax-code"><span>{{$order->receipt->company_tax_number}}</span></p>
                        <p class="confirm confirm-local"><span>{{$order->receipt->addr}}</span></p>
                        <p class="confirm confirm-email"><span>{{$order->receipt->email}}</span></p>
                        <p class="confirm confirm-phone"><span>{{$order->receipt->receipt_phone_number}}</span></p>
                    </div>
                    @endif
                    <div class="button-group">
                        <a class="back-to-buy" href="/shopping/" style="float:left;">Quay lại</a>
                        <button type="submit" class="common-button button-payment" style="float:right">thanh toán</button>
                    </div>
                </form>
            </div>
            <div class="order-overview">
                <div class="header-order-overview">
                    <h2>TỔNG QUAN ĐƠN HÀNG</h2><span>{{count($order->detail)}} sản phẩm</span>
                </div>
                <div class="body-order-overview">
                    @foreach ($order->detail as $item)
                    <div class="cart-item">
                        <div class="cart-item-inner">
                            <a class="cart-item-img" href="#"><img src="{{$item->product->images->first()['picture']}}"></a>
                            <div class="art-item-inner-info">
                                <p class="cats">{{$item->cate_name}}</p>
                                <h4><a href="#">{{$item->product_name}}</a></h4>
                                <p><span class="sale-price">{{number_format($item->product->discount_price)}}VND</span><span class="qty">X1</span></p>
                                <p>
                                    @if ($item->product->discount_price < $item->product->price)
                                        <span class="old-price">{{number_format($item->product->price)}}VND</span>
                                        @endif
                                </p>
                            </div>
                        </div>
                        <!-- <div class="delete">
                            <a href="#"><img src="images/delete.svg"></a>
                        </div> -->
                    </div>
                    @endforeach
                </div>
                <div class="footer-order-overview">
                    <div class="other-bonus">
                        <ul>
                            <!-- <li class="score">Tích luỹ được 32 điểm</li> -->
                            <li class="delivery">Freeship từ {{ number_format(setting('free_ship_min_cost', 500000))}}VND</li>
                        </ul>
                    </div>
                    <div class="coupon-code">
                        <h4>ÁP DỤNG MÃ KHUYẾN MÃI</h4><span>{{$order->coupon_code ?? 'Không có mã khuyến mãi'}}</span>
                    </div>
                    <div class="order-shopping-total">
                        <div class="sub_total">
                            <div class="detail">
                                <div>Thành tiền</div>
                                <div>{{number_format($order->subtotal)}} VND</div>
                            </div>
                            <div class="fee">
                                <div>Phí vận chuyển (Giao hàng tiêu chuẩn)</div>
                                <div>{{number_format($order->delivery_fee)}} VND</div>
                            </div>
                            @if ($order->coupon_code)
                            <div class="fee">
                                <div>Khuyến mãi</div>
                                <div>-{{number_format($order->discount)}} VND</div>
                            </div>
                            @endif
                        </div>
                        <p class="label-total">TỔNG CỘNG</p>
                        <p class="price-total">{{number_format($order->total)}}VND</p>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!--End cart-page-->
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
    $(document).ready(function($) {

    });

    $('.button-back').click(function() {
        $('#submit-form').attr('action', '/shopping/');
    });

    $('.button-payment').click(function() {
        $('#submit-form').attr('action', '/shopping/payment');
    });
</script>

@endpush