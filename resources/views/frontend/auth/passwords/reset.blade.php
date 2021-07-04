@extends('frontend.default')

@section('title', __('Reset Password'))

@section('content')
<div class="container" id="signup">
    <div class="container-signup">
        <div class="wrapper login">
            <h1>@lang('Reset Password')</h1>
            <div class="login-inner">
                <div class="login-form">
                <div class="login-error-msg">
                        @include('includes.partials.messages')
                    </div>
                    <x-frontend.card>
                        <x-slot name="body">
                            <x-forms.post :action="route('frontend.auth.password.update')">
                                <input type="hidden" name="token" value="{{ $token }}" />
                                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ $email ?? old('email') }}" maxlength="255" required autofocus autocomplete="email" readonly/>
                                <!--form-group-->
                                    <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('New Password') }}" maxlength="100" required autocomplete="password" />
                                <!--form-group-->

                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                                <!--form-group-->
                                <button class="common-button" type="submit">@lang('Reset Password')</button>
                                <!--form-group-->
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