@extends('layouts.app', ['title' => 'Forgot Password - SantriKoding.com'])

@section('content')
    <div class="row"
        style="margin-top: 60px">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success"
                            role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST"
                        action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Email Address</label>
                            <input id="email"
                                type="email"
                                class="mt-2 form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                                placeholder="Email Address">

                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="btn-group justify-content-between d-flex">
                            <button type="submit"
                                class="btn btn-primary mt-4 me-2 text-white">SEND RESET LINK</button>
                            <a href="{{ route('reset-phone') }}"
                                class="btn btn-warning mt-4">Mobile phone reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection
