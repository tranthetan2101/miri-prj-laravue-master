@if ($giftSet->count() > 0)
<div class="gift-set-inner">
    <div class="block">
        @foreach($giftSet as $product)
        <div class="block-inner">
            <div class="block-img">
                <p><img src="{{$product->images->first()['picture']}}"></p>
            </div>
            <div class="block-content">
                <p class="subcats">Combo</p>
                <h2>{{$product->name}}</h2>
                <p class="price">{{number_format($product->discount_price)}}</p>
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
@endif