@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Gift set')
@section('description', 'Gift set')
@section('og:title', 'Gift set')
@section('og:description', 'Gift set')

@section('content')
<div class="container" id="gift-set">
    <div class="wrapper gift-set">
        <h1>Combo</h1>
        <div class="gift-set-inner">
            <div class="gift-set-header">
                <p>Việc sử dụng mỹ phẩm theo combo và quy trình mà MIRI đã thiết kế sẵn sẽ giúp hiệu quả chăm sóc da tối ưu hơn, toàn diện hơn gấp nhiều lần so với chỉ dùng một loại duy nhất!
                    Đó là nhờ MIRI đã dày công nghiên cứu các sản phẩm với dưỡng chất thiên nhiên có thể kết hợp hài hòa, bổ sung lẫn nhau một cách hoàn hảo.
                    Bên cạnh đó, việc dùng combo sản phẩm cùng thương hiệu MIRI sẽ giúp nàng vừa tránh được phản ứng phụ, vừa tránh được việc phản tác dụng hoặc gây dị ứng cho làn da.
                    Tham khảo Combo tiết kiệm ngay!</p>
            </div>
            <div class="block">
                @foreach($products as $product)
                <div class="block-inner">
                    <div class="block-img">
                        <p><img src="{{$product->images->first()['picture']}}"></p>
                    </div>
                    <div class="block-content">
                        <p class="subcats">Combo</p>
                        <h2>{{$product->name}}</h2>
                        <p class="price">
                            <span class="sale-price">{{number_format($product->discount_price)}}VND</span>
                            @if ($product->discount_price < $product->price)
                                <span class="old-price">{{number_format($product->price)}}VND</span>
                            @endif
                        </p>
                        <div class="block-content-detail">
                            @foreach($product->productGiftSet as $giftProduct)
                            <p><a href="/product/detail/{{$giftProduct->id}}" style="color:black">- {{$giftProduct->name}}</a></p>
                            @endforeach
                        </div>
                        <a class="common-button" href="javascript:;" onclick="addGiftSet({{ $product->id }}, {{$product->discount_price}})">MUA NGAY</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--End gift-set-->
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
    $("#menu_gift").addClass('active');
</script>

@endpush