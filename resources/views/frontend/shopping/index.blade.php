@extends('frontend.default')


@section('keywords', 'MIRI')
@section('page_title', 'Checkout')
@section('description', 'Checkout')
@section('og:title', 'Checkout')
@section('og:description', 'Checkout')

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
                <div class="confirm-info">
                    <p class="confirm-info-title">Thông tin khách hàng</p>
                    <p class="confirm confirm-email"><span>{{$order->email}}</span>@if(!Auth::check())<a href="/shopping/info">Chỉnh sửa</a>@endif</p>
                    <p class="confirm confirm-user"><span>{{$order->name}}</span></p>
                    <p class="confirm confirm-phone"><span>{{$order->phone_number}}</span></p>
                    <p class="confirm confirm-address"><span>{{$order->addr_number}} {{ucwords($order->addr_street)}} {{$order->ward->type}} {{$order->ward->name}} {{$order->district->type}} {{$order->district->name}} {{$order->city->type}} {{$order->city->name}}</span></p>
                </div>

                <div class="open-form">
                    <div class="check">
                        <input class="check-it" type="checkbox" id="checkbox-address" name="address-checkbox" @if ($order->shipping) checked disabled @endif>
                        <label class="label-it" for="checkbox-address">Giao hàng đến địa chỉ khác</label>
                    </div>
                    @if ($order->shipping)
                    <div class="confirm-info address-confirm">
                        <p class='confirm confirm-user'><span>{{$order->shipping->name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$order->shipping->phone_number}}</span><a href='javascript:;'>Chỉnh sửa</a></p>
                        <p class='confirm confirm-local'><span>{{$order->shipping->addr_number}} {{ucwords($order->shipping->addr_street)}} {{$order->shipping->ward->type}} {{$order->shipping->ward->name}} {{$order->shipping->district->type}} {{$order->shipping->district->name}} {{$order->shipping->city->type}} {{$order->shipping->city->name}}</span></p>
                    </div>
                    @endif
                    <div class="open-form-info other-addr-div" style="display: none;">
                        @if (Auth::check())
                        @foreach ($address->take(3) as $addr)
                        <div class="confirm-info user-addr" style="margin-top: revert !important;">
                            <p class='confirm confirm-user'>
                                <span>{{$addr->name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$addr->phone_number}}</span>
                                <a href='javascript:;' data-name="{{$addr->name}}" data-phone_number="{{$addr->phone_number}}" data-addr_number="{{$addr->addr_number}}" data-addr_street="{{$addr->addr_street}}" data-ward="{{$addr->ward->id}}" data-district="{{$addr->district->id}}" data-city="{{$addr->city->id}}">Chọn địa chỉ này</a>
                            </p>
                            <p class="confirm confirm-local"><span>{{$addr->addr_number}} {{ucwords($addr->addr_street)}} {{$addr->ward->type}} {{$addr->ward->name}} {{$addr->district->type}} {{$addr->district->name}} {{$addr->city->type}} {{$addr->city->name}}</span></p>
                        </div>
                        @endforeach

                        <p style="margin-bottom: 25px;"><a class="additional">+ Thêm địa chỉ giao hàng</a></p>
                        <form id='other-addr-form' method="post" action="{{route('frontend.shopping.addOtherAddr')}}">
                            @csrf
                            <input type="hidden" name="name">
                            <input type="hidden" name="phone_number">
                            <input type="hidden" name="other_addr_number">
                            <input type="hidden" name="other_addr_street">
                            <input type="hidden" name="other_addr_street">
                            <input type="hidden" name="city_id">
                            <input type="hidden" name="district_id">
                            <input type="hidden" name="ward_id">
                            <div class="button-group">
                                <a class="back-to-buy cancel other-addr-cancel" href="{{route('frontend.shopping.cancelOtherAddr')}}">HỦY</a>
                            </div>
                        </form>
                        <form action="{{route('frontend.mypage.updateAddr')}}" class="addr-form" method="post" style="display:none">
                            @csrf
                            <div class="input-info">
                                <input type="hidden" name="user_id" value='{{ Auth::user()->id }}'>
                                <input type="text" name="name" placeholder="Họ và tên" value=''>
                                <input type="text" name="phone_number" placeholder="Số điện thoại" value=''>
                                <input type="text" name="addr_number" placeholder="Số nhà" value=''>
                                <input type="text" name="addr_street" placeholder="Địa chỉ" value=''>
                                <div class="select2">
                                    {{ html()->select('city_id')
                                    ->attribute('data-type', 'city')
                                    ->attribute('data-placeholder', 'Tỉnh/Thành phố')
                                    ->attribute('data-id', '')
                                    ->attribute('data-text', '')
                                    ->required()
                                    ->id('city_id')->class('form-control')}}
                                </div>
                                <div class="select2">
                                    {{ html()->select('district_id')
                                    ->attribute('data-type', 'district')
                                    ->attribute('data-placeholder', 'Quận/Huyện')
                                    ->attribute('data-parent', 'city_id')
                                    ->attribute('data-id', '')
                                    ->attribute('data-text', '')
                                    ->required()
                                    ->id('district_id')
                                    ->class('form-control')}}
                                </div>
                                <div class="select2">
                                    {{ html()->select('ward_id')
                                    ->attribute('data-type', 'ward')
                                    ->attribute('data-placeholder', 'Phường/Xã')
                                    ->attribute('data-parent', 'district_id')
                                    ->attribute('data-id', '')
                                    ->attribute('data-text', '')
                                    ->required()
                                    ->id('ward_id')
                                    ->class('form-control')}}
                                </div>
                            </div>
                            <div class="button-group">
                                <a class="back-to-buy cancel other-user-addr-cancel" href="javascript:;">HỦY</a>
                                <button class="common-button save other-addr-save">Lưu địa chỉ này</button>
                            </div>

                        </form>
                        @else
                        <form id='other-addr-form' method="post" action="{{route('frontend.shopping.addOtherAddr')}}">
                            @csrf
                            <input type="text" name="name" placeholder="Họ và tên" value="{{$order->shipping->name ?? ''}}">
                            <input type="text" name="phone_number" placeholder="Số điện thoại" value="{{$order->shipping->phone_number ?? ''}}">
                            <input type="text" required name="other_addr_number" placeholder="Số nhà" value="{{$order->shipping->addr_number ?? ''}}">
                            <input type="text" required name="other_addr_street" placeholder="Đường / Phố" value="{{$order->shipping->addr_street ?? ''}}">

                            <div class="select2">
                                {{ html()->select('city_id')
                                    ->attribute('data-type', 'city')
                                    ->attribute('data-placeholder', 'Tỉnh/Thành phố')
                                    ->attribute('data-id', $order->shipping->city->id ?? '')
                                    ->attribute('data-text', $order->shipping->city->name ?? '')
                                    ->required()
                                    ->id('city_id')->class('form-control')}}
                            </div>
                            <div class="select2">
                                {{ html()->select('district_id')
                                    ->attribute('data-type', 'district')
                                    ->attribute('data-placeholder', 'Quận/Huyện')
                                    ->attribute('data-parent', 'city_id')
                                    ->attribute('data-id', $order->shipping->district->id ?? '')
                                    ->attribute('data-text', $order->shipping->district->name ?? '')
                                    ->required()
                                    ->id('district_id')
                                    ->class('form-control')}}
                            </div>
                            <div class="select2">
                                {{ html()->select('ward_id')
                                    ->attribute('data-type', 'ward')
                                    ->attribute('data-placeholder', 'Phường/Xã')
                                    ->attribute('data-parent', 'district_id')
                                    ->attribute('data-id', $order->shipping->ward->id ?? '')
                                    ->attribute('data-text', $order->shipping->ward->name ?? '')
                                    ->required()
                                    ->id('ward_id')
                                    ->class('form-control')}}
                            </div>

                            <div class="button-group">
                                <a class="back-to-buy cancel other-addr-cancel" href="{{route('frontend.shopping.cancelOtherAddr')}}">HỦY</a>
                                <button class="common-button save other-addr-save">Lưu địa chỉ này</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="open-form">
                    <div class="check">
                        <input class="check-it" type="checkbox" id="checkbox-invoile" name="receipt_checkbox" @if ($order->receipt) checked disabled @endif>
                        <label class="label-it" for="checkbox-invoile">Xuất hoá đơn mua hàng</label>
                    </div>

                    @if ($order->receipt)
                    <div class="confirm-info receipt-confirm">
                        <p class="confirm-info-title">Thông tin xuất hoá đơn<a href="javascript:;">Chỉnh sửa</a></p>
                        <p class="confirm confirm-company"><span>{{$order->receipt->company_name}}</span></p>
                        <p class="confirm confirm-tax-code"><span>{{$order->receipt->company_tax_number}}</span></p>
                        <p class="confirm confirm-local"><span>{{$order->receipt->addr}}</span></p>
                        <p class="confirm confirm-email"><span>{{$order->receipt->email}}</span></p>
                        <p class="confirm confirm-phone"><span>{{$order->receipt->receipt_phone_number}}</span></p>
                    </div>
                    @endif
                    <div class="open-form-info receipt-form" style="display: none;">
                        <form id='receipt-form' method="post" action="{{route('frontend.shopping.addReceipt')}}">
                            @csrf
                            <input type="text" required name="receipt_company_name" placeholder="Tên công ty" value="{{$order->receipt->company_name ?? ''}}">
                            <input type="text" required name="receipt_tax_number" placeholder="Mã số thuế công ty" value="{{$order->receipt->company_tax_number ?? ''}}">
                            <input type="text" required name="receipt_addr" placeholder="Địa chỉ công ty" value="{{$order->receipt->addr ?? ''}}">
                            <input type="email" required name="receipt_email" placeholder="E-mail nhận hoá đơn" value="{{$order->receipt->email ?? ''}}">
                            <input type="number" required name="receipt_phone_number" placeholder="Số điện thoại người mua hàng" value="{{$order->receipt->receipt_phone_number ?? ''}}">

                            <div class="button-group">
                                <a class="back-to-buy cancel" href="{{route('frontend.shopping.cancelReceipt')}}">HỦY</a>
                                <button class="common-button save receipt-save">LƯU THÔNG TIN</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="input-info">
                    <textarea rows="10" cols="50" placeholder="Lưu ý nhận hàng" name="note">{{$order->note}}</textarea>
                </div>
                <div class="time-delivery">
                    <h2>GÓI HÀNG CỦA BẠN</h2>
                    <p>Giao hàng tiêu chuẩn ( 2-5 ngày )</p>
                </div>
                <form action="{{route('frontend.shopping.confirm')}}" method="post">
                    @csrf
                    <input type="hidden" name="note">
                    <input type="hidden" name="id_adr">
                    <button class="common-button button-confirm" type="submit"> tiếp tục</button>
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
                                <p><span class="sale-price">{{number_format($item->price)}}VND</span><span class="qty">X{{$item->quantity}}</span></p>
                                <p>
                                    @if ($item->price2 < $item->price)
                                        <span class="old-price">{{number_format($item->price)}}VND</span>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/vi.js"></script>
<script>
    $(function() {
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
<script type="text/javascript">
    $('input[name="address-checkbox"]').click(function() {
        $('.other-addr-div').toggle();
    });

    $('input[name="receipt_checkbox"]').click(function() {
        $('.receipt-form').toggle();
    });

    $(".address-confirm a").click(function() {
        $('.address-confirm').hide();
        $('.other-addr-div').show();
    });

    $(".user-addr a").click(function() {
        $('input[name="name"]').val($(this).data('name'));
        $('input[name="phone_number"]').val($(this).data('phone_number'));
        $('input[name="other_addr_number"]').val($(this).data('addr_number'));
        $('input[name="other_addr_street"]').val($(this).data('addr_street'));
        $('input[name="city_id"]').val($(this).data('city'));
        $('input[name="district_id"]').val($(this).data('district'));
        $('input[name="ward_id"]').val($(this).data('ward'));
        $('#other-addr-form').submit();
    });

    $(".receipt-confirm a").click(function() {
        $('.receipt-confirm').hide();
        $('.receipt-form').show();
    });

    $('.button-confirm').click(function() {
        $('input[name="note"]').val($('textarea[name="note"]').val());
    })

    $('.additional').click(function() {
        $('#other-addr-form').hide();
        $('.addr-form').show();
    })

    $('.other-user-addr-cancel').click(function() {
        $('#other-addr-form').show();
        $('.addr-form').hide();
    })

    $(document).ready(function() {
        if ($('#city_id').data('id') != '') {
            var cityNewOption = new Option($('#city_id').data('text'), $('#city_id').data('id'), true, true);
            // Append it to the select
            $('#city_id').append(cityNewOption).trigger('change');
        }

        if ($('#district_id').data('id') != '') {
            var districtNewOption = new Option($('#district_id').data('text'), $('#district_id').data('id'), true, true);
            // Append it to the select
            $('#district_id').append(districtNewOption).trigger('change');
        }

        if ($('#ward_id').data('id') != '') {
            var wardNewOption = new Option($('#ward_id').data('text'), $('#ward_id').data('id'), true, true);
            // Append it to the select
            $('#ward_id').append(wardNewOption).trigger('change');
        }
    });
</script>

@endpush
