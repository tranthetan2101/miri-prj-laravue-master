@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Điều khoản sử dụng')
@section('description', 'Điều khoản sử dụng')
@section('og:title', 'Điều khoản sử dụng')
@section('og:description', 'Điều khoản sử dụng')

@section('content')
    <div class="container">
        <div class="wrapper">
            <h1>Điều khoản sử dụng</h1>
            <div class="blog-inner blog-terms">
                {!! setting('terms', '') !!}
            </div>
        </div>
    </div>
@stop
