<ul class="list-product">
    @foreach($products as $index => $product)
    <li>
        <a href="{{route('frontend.product.detail', $product->id)}}">
            <p class="label">
                @if($product->sale->count() > 0)
                <span class="off">{{$product->sale->first()->name}}</span>
                @elseif (!empty($product->tag_sale))
                <span class="off">{{$product->tag_sale}}</span>
                @endif
                @if( $product->tag_best == 1)
                <span class="best">Best seller</span>
                @elseif ($product->tag_recommend == 1)
                <span class="best">Nên mua</span>
                @endif
            </p>
            <img src="{{$product->images->first()['picture']}}" />
            <p class="subcats">{{$product->category->name}}</p>
            <h3>{{$product->name}}</h3>
                <p class="price">
                    <span class="sale-price">{{number_format($product->discount_price)}}VND</span>
                    @if ($product->discount_price < $product->price)
                        <span class="old-price">{{number_format($product->price)}}VND</span>
                        @endif
                </p>
                <div class="rating-container">
                    <div class="ratings">
                        <div class="rating-box">
                            <div class="rating" style="width:{{($product->productRating()->avg('rating') * 100) / 5}}%;"></div>
                        </div>
                        <div class="amount">({{$product->productRating->count()}})</div>
                    </div>
                </div>


            <div class="countdown-km">
                @if($product->sale->count() > 0)
                <count-down :date="'{{$product->sale->first()->period_end->timestamp}}'"></count-down>
                @endif
            </div>
            @if ($product->stock > 0 || $product->stock_unlimited == 1)
            <button class="common-button-km">MUA NGAY</button>
            @else
            <button class="common-button-km sale-out" disabled>HẾT HÀNG</button>
            @endif
        </a>
    </li>
        @if (!empty($combo))
            @if ($index == $position || ($loop->last && $index < $position))
                <li class="special">
                    <a href="javascript:;">
                        <h3>{{$combo->name}}</h3>
                        <p>{{$combo->description}}</p>
                        <img src="{{ $combo->image }}"/>
                        <button onclick="addGiftSet({{ $combo->product_id }}, {{ $combo->discount_price }})">MUA NGAY</button>
                    </a>
                </li>
            @endif
        @endif
    @endforeach

</ul>
