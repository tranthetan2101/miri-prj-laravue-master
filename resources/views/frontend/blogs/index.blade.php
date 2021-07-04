@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Góc chia sẻ')
@section('description', 'Góc chia sẻ')
@section('og:title', 'Góc chia sẻ')
@section('og:description', 'Góc chia sẻ')

@section('content')
<div class="container">
    <div class="blog-page">
        <div class="wrapper">
            <p class="break-title">GÓC CHIA SẺ</p>
            <h1>Góc chia sẻ bí quyết làm đẹp</h1>
            <div class="blog-inner">
                <div class="newest">
                    <div><a href="/blog-miri/detail/{{$newest->id}}">
                            <div class="newest-img"><img src="{{ $newest->picture }}" /></div>
                            <div class="newest-content">
                                <h2>{{$newest->name}}</h2>
                                <p>{{$newest->description}}</p>
                                <button>Đọc tiếp</button>
                            </div>
                        </a></div>
                </div>

                <div class="flexslider-3 blog-inner">
                    <ul class="list-of-blog slides">
                        @foreach($blogs as $blog)
                            @if($blog->id!=$newest->id)
                        <li><a href="/blog-miri/detail/{{$blog->id}}">
                                <img src="{{ $blog->picture }}" />
                                <h3>{{$blog->name}}</h3>
                                <p>{{$blog->description}}</p>
                                <button>Đọc tiếp</button>
                            </a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!--End blog-->
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
    $("#menu_blog").addClass('active');
</script>

@endpush
