@if ($coupon->price >= 1000)
    {{number_format($coupon->price, 0, '', '.')}}
@else
    {{$coupon->price}}
@endif
