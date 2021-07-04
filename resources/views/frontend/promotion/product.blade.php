<ul class="list-product list-product-promotion">
    @foreach ($listProduct as $product)
    <li><a href="/product/detail/{{$product->id}}">
            <p class="label">
                <span class="off">{{$product->sale->first()->name}}</span>
                @if( $product->tag == 1)
                <span class="best">Best seller</span>
                @elseif ($product->tag == 2)
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
            <div class="countdown">
                <count-down :date="'{{$product->sale->first()->period_end->timestamp}}'"></count-down>
            </div>
            <button class="common-button">MUA NGAY</button>
        </a></li>
    @endforeach
{{--    <li class="special"><a href="#">--}}
{{--            <h1>Buy 2 get 1, 20% off</h1>--}}
{{--            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since ..</p>--}}
{{--            <img src="images/buyget.png" />--}}
{{--            <button>MUA NGAY</button>--}}
{{--        </a></li>--}}
</ul>
