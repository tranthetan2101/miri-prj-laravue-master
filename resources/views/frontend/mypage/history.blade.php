<div id="order-history" class="tab-content-inner-order @if(!$errors->any() && old('mode') == '') current @endif">
    @if ($orders->count())
    <h2>Lịch sử đơn hàng</h2>
    <div class="order-header">
        <ul class="order-item-ul">
            <li class="history-id">Mã đơn hàng</li>
            <li class="history-user">Người nhận</li>
            <li class="history-date">Ngày mua</li>
            <li class="history-total">Tổng tiền</li>
            <li class="history-method">Trạng thái</li>
        </ul>
    </div>
    <div class="order-body">
        @foreach ($orders as $index => $order)
        <div class="order-item">
            <a class="accordion-toggle @if ($index == 0) open @endif" href="#">
                <ul class="order-item-ul order-item-inner">
                    <li class="history-id">{{$order->uuid}}</li>
                    <li class="history-user">{{($order->shipping) ? $order->shipping->name : $order->name}}</li>
                    <li class="history-date">{{date('d/m/Y', strtotime($order->order_date))}}</li>
                    <li class="history-total">{{$order->total}}VND</li>
                    <li class="history-method">{{$order->getStatusAttribute()}}</li>
                </ul>
            </a>
            <ul class="panel" @if ($index==0) style="display: block;" @endif>
                @foreach ($order->detail as $item)
                <li><a href="">
                        <img src="{{$item->product->images->first()['picture']}}">
                        <h3>{{$item->product->name}}</h3>
                        <p class="money">{{number_format($item->price)}} VND X{{$item->quantity}}</p>
                    </a></li>
                @endforeach
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
                @if ($order->order_status == 1)
                <div style="text-align: right">
                    <form action="{{route('frontend.mypage.cancel')}}" method="post">
                        @csrf
                        <input type="hidden" name='id' value="{{$order->id}}">
                        <button class="order-cancel">Hủy đơn hàng</button>
                    </form>
                </div>
                @endif
            </ul>
        </div>
        @endforeach
    </div>
    @else
    <div class="button-group">
        <p class="alert-nothing">Oh. Bạn không có bất kỳ đơn đặt hàng nào.</p>
        <a class="common-button" href="/product/list">ĐẶT HÀNG NGAY</a>
    </div>
    @endif
</div>
