@if ($products->count() > 0)
<div class="products">
    <ul class="list-product">
        @foreach($products as $product)
        <li>
            <a href="/product/detail/{{$product->id}}">
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
                <p class="subcats">{{$product->category->first()->name}}</p>
                <h3>{{$product->name}}</h3>
                <p class="price">
                    <span class="sale-price">{{number_format($product->discount_price)}}VND</span>
                    @if ($product->discount_price < $product->price)
                        <span class="old-price">{{number_format($product->price)}}VND</span>
                        @endif
                </p>
                <div class="countdown">
                    @if($product->sale->count() > 0)
                    <count-down :date="'{{$product->sale->first()->period_end->timestamp}}'"></count-down>
                    @endif

                </div>
            </a>
            <a href="#on-cart" rel="modal:open" class="common-button">MUA NGAY</a>
        </li>
        @endforeach
    </ul>
</div>

@else
<p class="alert">Không tìm thấy kết quả nào.</p>
@endif
