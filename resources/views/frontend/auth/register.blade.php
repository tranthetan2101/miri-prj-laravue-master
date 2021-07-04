@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Register')
@section('description', 'Đăng ký tài khoản')
@section('og:title', 'Register')
@section('og:description', 'Đăng ký tài khoản')

@section('content')
<div class="container" id="signup">
    <div class="container-signup">
        <div class="wrapper login">
            <h1>Đăng ký tài khoản</h1>
            <div class="login-inner">
                <div class="login-form">
                    <div class="login-error-msg">
                        @include('includes.partials.messages')
                    </div>
                    <x-frontend.card>
                        <x-slot name="body">
                            <x-forms.post :action="route('frontend.auth.register')">
                                <input type="text" name="name" id="name" class="form-control @if ($errors->has('name')) is-invalid @elseif (old('name')) is-valid @endif" value="{{ old('name') }}" placeholder="Họ và tên của bạn" maxlength="100" required autofocus autocomplete="name" />
                                <input type="email" name="email" id="email" class="form-control @if ($errors->has('email')) is-invalid @elseif (old('email')) is-valid @endif" placeholder="E-mail của bạn" value="{{ old('email') }}" maxlength="255" required autocomplete="email" />
                                <input type="password" name="password" id="password" class="form-control @if ($errors->has('password')) is-invalid @endif" placeholder="Mật khẩu" maxlength="100" required autocomplete="new-password" />
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" maxlength="100" required autocomplete="new-password" />
                                <div class="email-mkt register-checkbox">
                                    <div>
                                        <input class="check-it" type="checkbox" id="checkbox-email" name="receive-info">
                                        <label class="label-it" for="checkbox-email">Tôi muốn nhận thư thông báo về các chương trình giảm giá và khuyến mãi</label>
                                    </div>
                                    <div>
                                        <input class="check-it" type="checkbox" id="checkbox-rules" name="rule">
                                        <label class="label-it" for="checkbox-rules"  @if ($errors->has('rule')) style="color:red !important"@endif>Tôi hiểu và đồng ý các Điều khoản và điều kiện của MIRI</label>
                                    </div>

                                </div>
                                @if(config('boilerplate.access.captcha.registration'))
                                <div class="row">
                                    <div class="col">
                                        @captcha
                                        <input type="hidden" name="captcha_status" value="true" />
                                    </div>
                                    <!--col-->
                                </div>
                                <!--row-->
                                @endif
                                <button class="common-button" type="submit">Đăng ký</button>
                            </x-forms.post>
                        </x-slot>
                    </x-frontend.card>
                </div>
            </div>
        </div>
        <!--End login-->
    </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        getDataForCity('info');
    })
</script>
@endpush