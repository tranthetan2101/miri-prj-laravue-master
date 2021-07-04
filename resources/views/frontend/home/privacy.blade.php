@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Chính sách quyền riêng tư')
@section('description', 'Chính sách quyền riêng tư')
@section('og:title', 'Chính sách quyền riêng tư')
@section('og:description', 'Chính sách quyền riêng tư')

@section('content')
<div class="container">
    <div class="wrapper">
        <h1>Chính sách quyền riêng tư</h1>
        <div class="blog-inner blog-privacy">
            {!! setting('privacy', '') !!}
        </div>
    </div>
</div>
@stop

