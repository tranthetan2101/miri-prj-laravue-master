@extends('frontend.default')
@section('content')
<div class="container" id="login">
    <div class="container-login">
        <div class="wrapper login">
            <h1>Đăng nhập tài khoản</h1>
            <div class="login-inner">
                <div class="login-form">
                    <div class="login-error-msg">
                        @include('includes.partials.messages')
                    </div>
                    <x-forms.post :action="route('frontend.auth.login')">
                        <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                        <p>Bạn chưa có tài khoản. <a href="/register">Đăng ký ngay.</a><a href="{{route('frontend.auth.password.request')}}">Quên mật khẩu ?</a></p>
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
                        <button type="submit" class="common-button">Đăng nhập</button>
                        <div class="text-center">
                            @include('frontend.auth.includes.social')
                        </div>
                    </x-forms.post>
                </div>
            </div>
        </div>
        <!--End login-->
    </div>
</div>
@stop