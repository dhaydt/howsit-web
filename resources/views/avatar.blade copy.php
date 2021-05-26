@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <h2>{{ $user->name }}'s Avatar</h2>
                <div class="img-divs">
                    <img class="profils" src="{{ url('/images/profile/'.Auth::user()->profile_image) }}">

                    <div class="change-pic">
                        <i class="fas fa-camera">
                            <input type="file" name="profile_image" id="img">
                        </i>
                    </div>
                </div>
                <label>Change Profile Image</label>
                {{-- <input type="file" name="profile_image"> --}}
                {{-- <input type="file" name="profile_image" id="img"> --}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary" value="Change">
            </form>

            <div class="card-body">
                <form method="POST" action="{{ url('/profile/update') }}">
                    @method('POST')
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-left">{{ __('Phone Number') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-3"></div>
    </div>
</div>

@endsection
<style lang="scss">
    .img-divs{
        display: inline-block;
        padding-left: 35%;
    }

    .profils {
        width:150px;
        height:150px;
        border-radius:50%;
        margin-right:25px;
    }

    input[type=file] {
        top: 10px;
        left: -70px;
        height: 50px !important;
        cursor: pointer !important;
        font-size: 12px;
        position: absolute;
    }

    .change-pic {
        background-color: rgb(41, 37, 37);
        border-radius: 50%;
        height: 45px;
        width: 45px;
        top: -50px;
        left: 100px;
        position: relative;
    }
    .change-pic i {
            position: relative;
            font-size: 27px;
            line-height: 1.6;
            left: 9px;
            color: white;
        }
</style>
