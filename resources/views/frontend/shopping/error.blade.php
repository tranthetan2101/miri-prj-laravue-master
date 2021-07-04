@extends('frontend.default')

@section('page_title')
SHOPPING MIRI
@stop

@section('content')
<div class="container">
    <div class="wrapper check-out">
        <h1>Thông báo</h1>
        <h2>Đã có lỗi xảy ra trong quá trình thanh toán. Vui lòng thanh toán lại hoặc liên hệ page để được giải quyết</h2>
        <br>
        @if ($message = Session::get('error'))
            <h2 style="color: red">{{ $message }}</h2>
        @endif
    </div>
</div>
@stop
