@extends('layouts.app')
@section('content')
<info-page :users="{{ auth()->user()}}" style="margin-top: -35px;"></info-page>
{{-- <a href="{{ url('auth/google') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">
        <strong>Login With Google</strong>
</a> --}}
{{-- <notify-item></notify-item> --}}
@endsection