@extends('frontend.master')
@section('content')
    <!--============= Sign In Section Starts Here =============-->
    <div class="account-section bg_img" data-background="{{ asset('assets/frontend/images/account-bg.jpg') }}">
        <div class="container">
            <div class="account-title text-center">
                <a href="{{ route('index') }}" class="back-home nav-link"><i class="fas fa-angle-left"></i><span>Back <span class="d-none d-sm-inline-block">To {{ $gnl->site_name }}</span></span></a>
                <a href="{{ route('index') }}" class="logo">
                    <img src="{{asset('assets/images/logo/'. $gnl->favicon )}}" alt="logo">
                </a>
            </div>
            <div class="account-title text-center">
                <h4 class="text-white">{{ $page_title }}</h4>
            </div>
            <div class="account-wrapper">
                <div class="account-body">
                    <h4 class="title mb-20">Verify your account</h4>
                    @if(!$user->email_verify)
                    <form class="account-form" action="{{ route('user.verify_email') }}" method="post" id="recaptchaForm">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <input type="text" class="form-control" name="email_verified_code" placeholder="@lang('Email verification')">
                            </div>
                            <div class=" form-group text-center">
                                <button type="submit" id="recaptcha" class="mt-2 mb-2">@lang('Verify Code')</button>
                            </div>
                            <div class="form-group ">
                                <p><a class="nav-link" href="{{route('user.send_verify_code')}}?type=email">@lang('Send Email Code')</a></p>
                            </div>
                        </div>
                    </form>

                @elseif(!$user->sms_verify)
                    <form class="account-form" action="{{ route('user.verify_sms') }}" method="post" id="recaptchaForm">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <input type="text" name="sms_verified_code" placeholder="@lang('SMS verification')" >
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" id="recaptcha"  class="mt-2 mb-2">@lang('Verify Code')</button>
                            </div>

                            <div class="form-group">
                                <p><a class="nav-link" href="{{route('user.send_verify_code')}}?type=phone">@lang('Send Verification Code')</a></p>
                            </div>
                        </div>
                    </form>

                @elseif(!$user->tv)
                    <form class="account-form" action="{{ route('user.go2fa.verify') }}" method="POST" id="recaptchaForm">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <input type="text" name="code" id="pincode-input">
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" id="recaptcha" class="mt-2 mb-2">@lang('Verify Code')</button>
                            </div>
                        </div>
                    </form>
                @endif
                </div>

            </div>
        </div>
    </div>
@endsection
