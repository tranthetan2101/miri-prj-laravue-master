<h2>Cảm ơn bạn đã đặt hàng tại <a href="{{url('/')}}">{{config('app.name')}}</a></h2>
<p><strong>Chi tiết đơn hàng <i>{{$order->uuid}}</i>:</strong></p>
<table width="100%" border="1" style="border-collapse: collapse;">
    <tr style="background-color: #15489B; color: white;">
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>
    @foreach($order->detail as $item)
        <tr>
            <td>{{$item->product_name}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{number_format($item->price)}} VND X{{$item->quantity}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2"></td>
        <td>
            <div class="detail">
                <div>Thành tiền: {{number_format($order->subtotal)}} VND</div>
            </div>
            <div class="fee">
                <div>Phí vận chuyển (Giao hàng tiêu chuẩn): {{number_format($order->delivery_fee)}} VND</div>
            </div>
            <div class="fee">
                <div>Phương thức thanh toán: {{$order->payment_type}}</div>
            </div>
            @if ($order->coupon_code)
                <div class="fee">
                    <div>Khuyến mãi: -{{number_format($order->discount)}} VND</div>
                </div>
            @endif
        </td>
    </tr>
</table>

Chân thành cảm ơn,<br>
{{ config('app.name') }}
