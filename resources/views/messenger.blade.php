@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 100vw;">
        <div class="col">
            <div class="card">
                {{-- <div class="card-headers">
                <h4>Send messenger as {{ Auth::user()->name }}</h4>
                </div> --}}
                <chat-app :users="{{ auth()->user()}}"></chat-app>
            </div>
        </div>
    </div>
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
