@extends('frontend.default')

@section('content')
<div class="container-home">
<slide-show-component></slide-show-component>
<favorite-product-component></favorite-product-component>
<category-component></category-component>
<couple-product-component></couple-product-component>
<news-share-component></news-share-component>
<ad-component vid="{{$vid}}"></ad-component>
<story-component></story-component>
<receive-info-component></receive-info-component>
<div id="scroll-top"><a href="#"><img src="{{ asset('images/totop.svg') }}" width="17" height="53"></a></div>
</div>
@stop
