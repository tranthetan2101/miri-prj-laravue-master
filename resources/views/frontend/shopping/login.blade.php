@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Login')
@section('description', 'Login')
@section('og:title', 'Login')
@section('og:description', 'Login')

@section('content')
<div class="container">
    <div class="wrapper check-out">
        <h1>Thanh toán</h1>
        <div class="check-out-inner">

            <div class="login-form">
                <h2>BẠN ĐÃ CÓ TÀI KHOẢN MIRI ?</h2>
                <x-forms.post :action="route('frontend.auth.login')">
                    <input type="hidden" name="mode" value="shopping">
                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                    <p>Bạn chưa có tài khoản. <a href="/register">Đăng ký ngay.</a><a href="#">Quên mật khẩu ?</a></p>
                    @if(config('boilerplate.access.captcha.login'))
                    <div class="row">
                        <div class="col">
                            @captcha
                            <input type="hidden" name="captcha_status" value="true" />
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
                    @endif
                    <div>
                        @include('includes.partials.messages')
                    </div>
                    <button type="submit" class="common-button">Đăng nhập</button>
                    <div class="text-center">
                        @include('frontend.auth.includes.social')
                    </div>
                </x-forms.post>
            </div>
            <div class="quick-buy">
                <h2>MUA NHANH</h2>
                <p>Bạn có thể mua hàng như 1 vị khách. Bạn sẽ chỉ cần điền các chi tiết cần thiết để đặt hàng. Nếu muốn, bạn có thể đăng ký và lưu thông tin chi tiết của mình cho các lần mua hàng trong tương lai khi kết thúc quá trình mua hàng</p>
                <a href="/shopping/info" class="common-button">tiếp tục</a>
            </div>


        </div>
    </div>
    <!--End cart-page-->
</div>
@stop