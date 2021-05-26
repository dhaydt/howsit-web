@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-headers">
                    <h4>Send messenger as {{ Auth::user()->name }}</h4>
                    </div>
                    <chat-app :users="{{ auth()->user()}}"></chat-app>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        border: none !important;
    }
    .card-headers {
        background-color: #ebecf0;
        padding: 10px;
    }

    h4 {
        font-size: 20px;
        font-weight: 500;
        color: #555;
        margin: 0;
        text-transform: capitalize !important;
        text-align: center;
    }
    }
</style>
