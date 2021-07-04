@if (!empty($cart) && $cart->detail->count())
<div class="header-on-cart">
    <p>Giỏ hàng: {{$cart->detail->count()}} sản phẩm</p>
</div>
<div class="body-on-cart">
    @foreach ($cart->detail as $item)
    <div class="cart-item">
        <div>
            <a class="cart-item-img" href="#"><img src="{{$item->product->images->first()['picture']}}"></a>
            <h3><a href="#">{{$item->product->name}}</a></h3>
            <div class="qty-input">
                @if ($item->discount_price != 0)
                <i class="less" data-id="{{$item->id}}" onclick="handleCart($(this).data('id'), 'down');"></i>
                <input type="number" class="{{$item->id}}-quantity" value="{{$item->quantity}}" data-id="{{$item->id}}" data-old="{{$item->quantity}}" onfocusout="if ($(this).val() == '') $(this).val(0);if ($(this).data('old') != $(this).val()) handleCart($(this).data('id'), 'change', $(this).val());"/>
                <i class="more" data-id="{{$item->id}}" onclick="handleCart($(this).data('id'), 'up');"></i>
                @else
                <input type="text" disabled value="{{$item->quantity}}">
                @endif
            </div>
            <p><span class="sale-price">{{number_format($item->discount_price)}}VND</span>@if(($item->discount_price < $item->product->price) && ($item->discount_price != 0))<span class="old-price">{{number_format($item->product->price)}}VND</span>@endif</p>
            <!-- <a class="gift-bonus" href="#">Tặng kèm sữa rửa mặt tạo bọt</a> -->
        </div>
        @if ($item->discount_price != 0)
        <div class="delete" data-id="{{$item->id}}" onclick="handleCart($(this).data('id'), 'delete');">
            <a href="#"><img src="/images/delete.svg"></a>
        </div>
        @endif
    </div>
    @endforeach
</div>
<div class="footer-on-cart">
    <form action="/cart" method="get">
        <div class="total cartOnTotal">
            <p>Thành tiền</p>
            <p>{{number_format($cart->discount_price)}}VND</p>
            @if ($cart->discount_price < $cart->price)
                <p>{{number_format($cart->price)}}VND</p>
            @endif
        </div>
        <button type="submit">THANH TOÁN</button>
    </form>
{{--    <div class="cross-sale">--}}
{{--        <p>Bạn cần mua thêm 186,000VND nữa để nhận được quà tặng <a href="#">Kem thâm mụn</a></p>--}}
{{--    </div>--}}
</div>
@else
<div class="header-on-cart">
    <p>Không có sản phẩm</p>
</div>
@endif
