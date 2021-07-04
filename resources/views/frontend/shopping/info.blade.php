@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Checkout guest info')
@section('description', 'Checkout guest info')
@section('og:title', 'Checkout guest info')
@section('og:description', 'Checkout guest info')

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
                <h2>ĐIỀN THÔNG TIN GIAO HÀNG</h2>
                <form action="{{route('frontend.shopping.postInfo')}}" method="post">
                    @csrf
                    <div class="input-info">
                        <label for="name">Họ và tên</label>
                        <input type="text" required name="name" placeholder="Họ và tên" value="{{ $order->name ?? old('name') }}" style="margin-top: 10px" class="@if ($errors->has('name')) is-invalid @elseif (old('name')) is-valid @endif">
                        <label for="email">Email</label>
                        <input type="email" required name="email" placeholder="E-mail" value="{{ $order->email ?? old('email') }}" style="margin-top: 10px" class="@if ($errors->has('email')) is-invalid @elseif (old('email')) is-valid @endif">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" required maxlength="15" id="phone" name="phone" placeholder="Số điện thoại đặt hàng" value="{{ $order->phone_number ?? old('phone') }}" style="margin-top: 10px" class="@if ($errors->has('phone')) is-invalid @elseif (old('phone')) is-valid @endif">
                        <label for="receive_phone_number">Số điện thoại nhận hàng</label>
                        <input type="text" required maxlength="15" id="receive_phone_number" name="receive_phone_number" placeholder="Số điện thoại người nhận hàng" style="margin-top: 10px" value="{{ $order->receive_phone_number ?? old('receive_phone_number') }}" class="@if ($errors->has('receive_phone_number')) is-invalid @elseif (old('receive_phone_number')) is-valid @endif">
                        <label for="addr_number">Số nhà</label>
                        <input type="text" required name="addr_number" placeholder="Số nhà" value="{{ $order->addr_number ?? old('addr_number') }}" style="margin-top: 10px" class="@if ($errors->has('addr_number')) is-invalid @elseif (old('addr_number')) is-valid @endif">
                        <label for="addr_street">Đường/ Phố</label>
                        <input type="text" required name="addr_street" placeholder="Đường / Phố" value="{{ $order->addr_street ?? old('addr_street') }}" style="margin-top: 10px" class="@if ($errors->has('addr_street')) is-invalid @elseif (old('addr_street')) is-valid @endif">

                        <label for="city">Thành phố</label>
                        <div class="select2" style="margin-top: 10px"> 
                            {{ html()->select('city_id')
                                ->attribute('data-type', 'city')
                                ->attribute('data-placeholder', 'Tỉnh/Thành phố')
                                ->options([$order->city->id ?? null => $order->city->name ?? null])
                                ->required()
                                ->id('city_id')->class('form-control')}}
                        </div>

                        <label for="district">Quận/Huyện</label>
                        <div class="select2" style="margin-top: 10px">
                            {{ html()->select('district_id')
                                ->attribute('data-type', 'district')
                                ->attribute('data-placeholder', 'Quận/Huyện')
                                ->attribute('data-parent', 'city_id')
                                ->options([$order->district->id ?? null => $order->district->name ?? null])
                                ->id('district_id')
                                ->required()
                                ->class('form-control')}}
                        </div>

                        <label for="ward">Phường/Xã</label>
                        <div class="select2" style="margin-top: 10px">
                            {{ html()->select('ward_id')
                                ->attribute('data-type', 'ward')
                                ->attribute('data-placeholder', 'Phường/Xã')
                                ->attribute('data-parent', 'district_id')
                                ->options([$order->ward->id ?? null => $order->ward->name ?? null])
                                ->required()
                                ->id('ward_id')
                                ->class('form-control')}}
                        </div>
                    </div>

                    <div class="open-form">
                    </div>

                    <div class="time-delivery">
                        <h2>GÓI HÀNG CỦA BẠN</h2>
                        <p>Giao hàng tiêu chuẩn ( 2-5 ngày )</p>
                    </div>

                    <div class="email-mkt">
                        <div>
                            <input class="check-it" type="checkbox" id="checkbox-email" name="receive-info">
                            <label class="label-it" for="checkbox-email">Tôi muốn nhận thư thông báo về các chương trình giảm giá và khuyến mãi</label>
                        </div>
                        <div>
                            <input class="check-it" type="checkbox" id="checkbox-rules" name="rule">
                            <label class="label-it" for="checkbox-rules" @if ($errors->has('rule')) style="color:red !important"@endif>Tôi hiểu và đồng ý các Điều khoản và điều kiện của MIRI</label>
                        </div>

                    </div>

                    <button type="submit" class="common-button">tiếp tục</button>

                </form>
            </div>
            <div class="order-overview">
                <div class="header-order-overview">
                    <h2>TỔNG QUAN ĐƠN HÀNG</h2><span>{{count($cart->detail)}} sản phẩm</span>
                </div>
                <div class="body-order-overview">
                    @foreach ($cart->detail as $item)
                    <div class="cart-item">
                        <div class="cart-item-inner">
                            <a class="cart-item-img" href="#"><img src="{{$item->product->images->first()['picture']}}"></a>
                            <div class="art-item-inner-info">
                                <p class="cats">{{$item->cate_name}}</p>
                                <h4><a href="#">{{$item->product_name}}</a></h4>
                                <p><span class="sale-price">{{number_format($item->discount_price)}}VND</span><span class="qty">X{{$item->quantity}}</span></p>
                                @if ($item->discount_price != 0)
                                <p>
                                    @if ($item->product->discount_price < $item->product->price)
                                        <span class="old-price">{{number_format($item->product->price)}}VND</span>
                                        @endif
                                </p>
                                @endif
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
                        <h4>ÁP DỤNG MÃ KHUYẾN MÃI</h4><span>{{$cart->coupon->code ?? 'Không có mã khuyến mãi'}}</span>
                    </div>
                    <div class="order-shopping-total">
                        <div class="sub_total">
                            <div class="detail">
                                <div>Thành tiền</div>
                                <div>{{number_format($cart->discount_price)}} VND</div>
                            </div>
                            @if ($cart->coupon)
                            <div class="fee">
                                <div>Khuyến mãi</div>
                                <div>-{{number_format($cart->coupon->price)}} VND</div>
                            </div>
                            @endif
                        </div>
                        <p class="label-total">TỔNG CỘNG</p>
                        @if ($cart->coupon)
                        <p class="price-total">{{number_format(($cart->discount_price - $cart->coupon->price > 0) ? $cart->discount_price - $cart->coupon->price : 0) }}VND</p>
                        @else
                        <p class="price-total">{{number_format($cart->discount_price) }}VND</p>
                        @endif
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!--End cart-page-->
</div>
@stop
@push('after-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/vi.js"></script>
<script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $(function() {
        $('#phone,#receive_phone_number').inputmask({
            alias: "abstractphone",
            rightAlign: false,
            allowPlus: false,
            allowMinus: false
        });
        $('#city_id').change(function() {
            $('#district_id').val(null).trigger('change');
            $('#ward_id').val(null).trigger('change');
        });

        $('#district_id').change(function() {
            $('#ward_id').val(null).trigger('change');
        });
        $('#city_id,#district_id,#ward_id').select2({
            language: 'vi',
            minimumInputLength: 1,
            ajax: {
                url: "{{ route('component.Component.locations') }}",
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        type: $(this).data('type'),
                        parent: $('#' + $(this).data('parent')).val()
                    };
                },
                processResults: function(response, params) {
                    params.page = params.page || 1;
                    let results = $.map(response.data, function(obj) {
                        obj.text = obj.text || obj.name; // replace pk with your identifier
                        return obj;
                    });
                    return {
                        results: results,
                        pagination: {
                            more: (params.page * response.per_page) < response.total
                        }
                    };
                },
                cache: true
            }
        });
    });
</script>
@endpush
