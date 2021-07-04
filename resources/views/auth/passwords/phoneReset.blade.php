@extends('layouts.app', ['title' => 'Reset Password - Howsit-Web'])

@section('content')
    <div class="row"
        style="margin-top: 60px;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">

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

                    <form method="POST"
                        action="{{ route('phone-updatePassword') }}">
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Phone Number</label>
                            <input id="phone"
                                type="text"
                                class="form-control"
                                name="phone"
                                value="{{ $phone }}"
                                required
                                autofocus
                                placeholder="Phone">
                            @error('phone')
                                <div class="alert alert-danger mt-2">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Password</label>
                            <input id="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="New Password">
                            @error('password')
                                <div class="alert alert-danger mt-2">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Confirm Password</label>
                            <input id="password-confirm"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Confirm New Password">
                        </div>

                        <button type="submit"
                            class="btn btn-primary btn-block">RESET PASSWORD</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection
