@extends('layouts.app')
@section('content')
    <div class="container"
        style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Phone Number') }}</div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger"
                                role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        {{-- Please enter the OTP sent to your number: {{Auth()->user()->phone}} --}}
                        <form action="{{ route('phone-check') }}"
                            method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                <div class="col-md-6">
                                    <input id="phone"
                                        type="tel"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Ex: +12124614595"
                                        name="phone"
                                        required>
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
                                        {{ __('Verify Phone Number') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
