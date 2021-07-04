<?php
use Illuminate\Support\Carbon;
?>
<div class="favorite-product">
    <h2>Khuyến mãi mới nhất</h2>
    <div class="flexslider-1">
        <ul class="slides list-product">
            @foreach($newestSales as $product)
            <li>
                <a href="/product/detail/{{$product->product_id}}">
                    <p class="label"><span class="off">{{$product->name}}</span></p>
                    <img src="{{$product->images->first()['picture']}}" />
                    <p class="subcats">{{$product->category->name}}</p>
                    <h3>{{$product->product_name}}</h3>
                    <p class="price">
                        <span class="sale-price">{{number_format($product->discount_price)}}VND</span>
                        @if ($product->discount_price < $product->price)
                            <span class="old-price">{{number_format($product->price)}}VND</span>
                            @endif
                    </p>
                    <div class="countdown">
                        <count-down :date="'{{Carbon::createFromFormat('Y-m-d H:i:s', $product->period_end)->timestamp}}'"></count-down>
                    </div>
                    <button class="common-button">MUA NGAY</button>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
