@extends('layouts.app')

@section('content')

                <chat-app :users="{{ auth()->user()}}"></chat-app>
@endsection

<style>
.py-4 {
    padding-top: 0 !important;
}
.container .col {
    width: 100%;
    padding: 0 0;
}
</style>
