<div class="favorite-product">
    <h2>Sản phẩm bạn vừa xem</h2>
    <div class="flexslider-1">
        <ul class="slides list-product">
            @foreach ($lastSeen as $product)
            <li>
                <a href="/product/detail/{{$product->id}}">
                    <p class="label">
                        @if ($product->sale->count() > 0)
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
                    <p class="price-lv">
                        <span class="sale-price">{{number_format($product->discount_price)}}VND</span>
                        @if ($product->discount_price < $product->price)
                            <span class="old-price">{{number_format($product->price)}}VND</span>
                            @endif
                    </p>
                    <div class="countdown-km">
                        @if($product->sale->count())
                        <count-down :date="'{{$product->sale->first()->period_end->timestamp}}'"></count-down>
                        @endif
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
