<h1>Giỏ hàng của bạn</h1>
<div class="cart-page-inner">
    @foreach($cart->detail as $item)
    <div class="cart-item">
        <div class="cart-item-inner">
            <a class="cart-item-img" href="{{route('frontend.product.detail',['id' => $item->product_id])}}"><img src="{{$item->product->images->first()['picture']}}"></a>
            <div class="item-info">
                <div>
                    <p class="cats">{{$item->product->name}}</p>
                    <h3><a href="{{route('frontend.product.list',['id' => $item->product->category->id])}}">{{$item->product->category->name}}</a></h3>
                </div>
                @if ($item->discount_price != 0)
                @if( $item->product->sale->count() > 0)
                <span class="off">{{$item->product->sale->first()->name}}</span>
                @elseif (!empty($item->product->tag_sale))
                <span class="off">{{$item->product->tag_sale}}</span>
                @endif
                @endif
            </div>
            <div class="qty-input">
                @if ($item->discount_price != 0)
                <i class="less" data-id="{{$item->id}}" onclick="handleCart($(this).data('id'), 'down');"></i>
                <input type="number" class="{{$item->id}}-quantity" value="{{$item->quantity}}" data-id="{{$item->id}}" onfocusout="if ($(this).val() == '') $(this).val(0);handleCart($(this).data('id'), 'change', $(this).val());" />
                <i class="more" data-id="{{$item->id}}" onclick="handleCart($(this).data('id'), 'up');"></i>
                @else
                <input type="text" disabled value="{{$item->quantity}}">
                @endif
            </div>
            <p class="price-each-item">
                <span class="sale-price">{{number_format($item->discount_price)}}VND</span>
                @if ($item->discount_price < $item->product->price && $item->discount_price != 0)
                    <span class="old-price">{{number_format($item->product->price)}}VND</span>
                    @endif
            </p>
        </div>
        @if ($item->discount_price != 0)
        <div class="delete" data-id="{{$item->id}}" onclick="handleCart($(this).data('id'), 'delete');">
            <a href="javascript:;"><img src="{{ asset('images/delete.svg') }}"></a>
        </div>
        @endif
    </div>
    @endforeach
</div>
<div class="coupon">
    <div class="coupon-input">
        <h3>NHẬP MÃ KHUYẾN MÃI</h3>
        <form action="#">
            <input type="text" name="coupon" placeholder="Mã khuyến mãi" value="{{$cart->coupon->code ?? ''}}" data-code="{{$cart->coupon->code ?? ''}}" onfocusout="">
            <button type="submit" name="coupon-submit" class="coupon-button" onclick='event.preventDefault();if ($("input[name=\"coupon\"]").val() != "") {addDiscount($("input[name=\"coupon\"]").val())}'>Áp dụng</button>
        </form>
    </div>
    <div class="other-bonus">
        <ul>
            <!-- <li class="score">Tích luỹ được 32 điểm</li> -->
            <li class="delivery">Freeship từ {{ number_format(setting('free_ship_min_cost', 500000))}}VND</li>
        </ul>
    </div>
</div>
<div class="footer-cart-page">
    <div class="cross-sale">
        <!-- <p>Bạn cần mua thêm <b>186,000VND</b> nữa để nhận được quà tặng <a href="#">Kem thâm mụn</a></p> -->
    </div>
    <form action="/cart/checkout" method="get">
        <div class="order-shopping-total">
            <div class="sub_total">
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
            @if ($cart->discount_price < $cart->price)
                <p class="old-price">{{number_format($cart->price)}}VND</p>
                @endif
        </div>
        <div class="button-group">
            <a class="back-to-buy" href="/">tiếp tục mua hàng</a>
            <button class="common-button" type="submit">THANH TOÁN</button>
        </div>

    </form>
</div>