@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Checkout payment')
@section('description', 'Checkout payment')
@section('og:title', 'Checkout payment')
@section('og:description', 'Checkout payment')

@section('content')
<div class="container">
    <div class="wrapper check-out">
        <h1>Thanh toán</h1>
        <div class="processing">
            <ol id="progress-bar">
                <li class="info-icon">1. Điền thông tin</li>
                <li class="pay-icon step-active">2. Thanh toán</li>
                <li class="finish-icon">3. Hoàn thành</li>
            </ol>
        </div>
        <div class="wrap-info">
            <div class="payment-method">
                <h2>HÌNH THỨC THANH TOÁN</h2>
                <div class="payment-method-tabs">
                    <ul>
                        @if(in_array('COD', setting('payment_methods')))
                        <li class="tab-link current" data-tab="COD">
                            <p><img src="{{ asset('images/cash.svg') }}"></p>
                            <p>Tiền mặt</p>
                        </li>
                        @endif
                        @if(in_array('ATM', setting('payment_methods')))
                        <li class="tab-link" data-tab="ATM">
                            <p><img src="{{ asset('images/atm.svg') }}"></p>
                            <p>Thẻ ATM nội địa</p>
                        </li>
                        @endif
                        @if(in_array('CC', setting('payment_methods')))
                        <li class="tab-link" data-tab="CC">
                            <p><img src="{{ asset('images/visa.svg') }}"></p>
                            <p>VISA</p>
                        </li>
                        @endif
                        @if(in_array('MOMO', setting('payment_methods')))
                        <li class="tab-link" data-tab="MOMO">
                            <p><img src="{{ asset('images/momo.svg') }}"></p>
                            <p>Momo E-wallet</p>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="visa" class="tab-content-inner-payment">
                        <ul class="bill">
                            <li>
                                <p class="bill-tite">Mã đơn hàng</p>
                                <p class="bill-info order-code">GIHUKI9860</p>
                            </li>
                            <li>
                                <p class="bill-tite">Giá trị đơn hàng</p>
                                <p class="bill-info order-total">1.381.000VND</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="button-group">
                    <a class="back-to-buy" href="{{route('frontend.shopping')}}">tiếp tục mua hàng</a>
                    <form action="{{route('frontend.shopping.post.payment')}}" method="post" class="checkoutForm">
                        <input type="hidden" name="payment_method" value="COD">
                        @csrf
                        <a class="common-button checkOut" href="javascript:;" >Thanh toán</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End payment-method-->
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
    $('.tab-link').click(function(){
        $('input[name="payment_method"]').val($(this).data('tab'));
    })

    $('.checkOut').click(function(){
        $('.checkoutForm').submit();
    })
</script>

@endpush
