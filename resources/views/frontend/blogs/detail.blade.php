@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', $blog->name)
@section('description', $blog->description)
@section('og:title', $blog->name)
@section('og:description', $blog->description)

@section('content')
<div class="container">
    <div class="wrapper">
        <h1>{{ $blog->name }}</h1>
        <div class="blog-inner">
            <div class="hero-image">
                <p><img style="width: 100%" src="{{$blog->picture}}"></p>
            </div>
            <div class="blog-content">
                {!! $blog->data !!}
            </div>
            <div class="earn-media">
                <ul>
                    <li>Chia sẻ bài viết:</li>
                    <li><a data-link="{{Request::url()}}" class="fb-share-btn" href="javascript:void(0);"><img src="/images/fb-share.svg"></a></li>
{{--                    <li><a href="#"><img src="/images/yu-share.svg"></a></li>--}}
{{--                    <li><a href="#"><img src="/images/insta-share.svg"></a></li>--}}
                </ul>
            </div>
        </div>
    </div>
<div class="blog">
    <h2>Bài viết khác</h2>
    <div class="flexslider-3 blog-inner">
        <ul class="list-of-blog slides">
            @foreach($blogs as $relateBlog)
                @if($relateBlog->id!=$blog->id)
            <li><a href="/blog-miri/detail/{{$relateBlog->id}}">
                    <img src="{{ $relateBlog->picture }}" />
                    <h3>{{$relateBlog->name}}</h3>
                    <p>{{$relateBlog->description}}</p>
                    <button>Đọc tiếp</button>
                </a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
</div>
@stop

@push('after-scripts')
<script type="text/javascript">
	$("#menu_blog").addClass('active');
</script>
@endpush
