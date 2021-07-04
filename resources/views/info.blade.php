@extends('layouts.app')
@section('content')
        <info-page :users="{{ auth()->user()}}" style="margin-top: -35px;"></info-page>
        {{-- <notify-item></notify-item> --}}
@endsection
