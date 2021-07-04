@extends('layouts.app')

@section('content')
    <div class="container"
        style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password SMS') }}</div>

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

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success"
                                role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST"
                            action="{{ route('postForget') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone"
                                        type="string"
                                        class="form-control @error('string') is-invalid @enderror"
                                        name="phone"
                                        placeholder="Ex: +12124614595"
                                        required
                                        autocomplete="phone"
                                        autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback"
                                            role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit"
                                        class="btn btn-primary">
                                        {{ __('Send Password Reset OTP') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            {{ __('If you did not verify your phone number yet, click in bellow link for a verification number.') }}
                            {{-- {{ __('If you did not receive the email') }}, --}}
                            {{-- <form class="d-inline"
                        method="POST"
                        action="{{ route('verification.resend') }}">
                        @csrf --}}
                            <a href="{{ route('phone-verify') }}"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to verify number') }}</a>.
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
