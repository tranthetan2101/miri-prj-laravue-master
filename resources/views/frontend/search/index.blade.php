@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Kết quả tìm kiếm với '. $searchTerm)
@section('description', 'Kết quả tìm kiếm với từ khóa')
@section('og:title', 'Kết quả tìm kiếm với '. $searchTerm)
@section('og:description', 'Kết quả tìm kiếm với từ khóa')

@section('content')
<div class="container">
    <div class="wrapper">
        <h1 class="thank-pc">Kết quả cho: {{$searchTerm}} ({{$products->count() + $giftSet->count() + $blogs->count()}})</h1>
        <h1 class="thank-mobile">Kết quả cho:</br> {{$searchTerm}} ({{$products->count() + $giftSet->count() + $blogs->count()}})</h1>
        <div class="result-tabs">
            <ul>
                <li class="tab-link current" data-tab="result-of-product">Sản phẩm <span>({{$products->count()}})</span></li>
                <li class="tab-link " data-tab="result-of-gift-set">Combo <span>({{$giftSet->count()}})</span></li>
                <li class="tab-link " data-tab="result-of-blog">Góc chia sẻ <span>({{$blogs->count()}})</span></li>
            </ul>
        </div>
        <div class="result-tab-content tab-content">
            <div id="result-of-product" class="tab-content-inner-result current">
                @include('frontend.search.product')
            </div>
            <div id="result-of-gift-set" class="tab-content-inner-result">
                @include('frontend.search.giftSet')
            </div>
            <div id="result-of-blog" class="tab-content-inner-result">
                @include('frontend.search.blog')
                
            </div>
        </div>
    </div>
    <!--End payment-method-->
</div>
@stop