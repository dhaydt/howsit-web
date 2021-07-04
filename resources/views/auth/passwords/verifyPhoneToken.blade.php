@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verification OTP') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger"
                                role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('post-verify') }}">
                            @csrf

                            <input type="hidden" name="phone" value="{{$phone}}">

                            <div class="form-group">
                                <label class="font-weight-bold text-uppercase">{{ __('Code_OTP') }}</label>
                                <input id="verification_code"
                                    type="text"
                                    class="mt-2 form-control"
                                    name="verification_code"
                                    required>
                            </div>
                            <button type="submit"
                                class="btn btn-primary mt-4 btn-block">Reset Password</button>
                        </form>
                        @if (session('resent'))
                            <div class="alert alert-success"
                                role="alert">
                                {{ __('A fresh OTP  has been sent to your phone number.') }}
                            </div>
                        @endif
{{--
                        {{ __('Before proceeding, please check your phone for a OTP code.') }}
                        {{ __('If you did not receive the code') }},
                        <form class="d-inline"
                            method="POST"
                            action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
