@extends('frontend.default')

@section('title', __('Reset Password'))

@section('content')
<div class="container" id="signup">
    <div class="container-signup">
        <div class="wrapper login">
            <h1>@lang('Reset Password')</h1>
            @if(session()->get('status'))
            <p style="text-align: center;">{{ session()->get('status') }}</p>
            @else
            <div class="login-inner">
                <div class="login-form">
                    <x-frontend.card>
                        <x-slot name="body">
                            <x-forms.post :action="route('frontend.auth.password.email')">
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('E-mail Address') }}" maxlength="255" required autofocus autocomplete="email" />
                                <!--form-group-->
                                <button class="common-button" type="submit">@lang('Send Password Reset Link')</button>
                                <!--form-group-->
                            </x-forms.post>
                        </x-slot>
                    </x-frontend.card>
                </div>
            </div>
            @endif
        </div>
        <!--End login-->
    </div>
</div>
@endsection