@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <div class="cards-container">
                <div class="cardu card-one">
                    <form action="/profile" enctype="multipart/form-data" method="POST">
                        <header>
                            <div class="avatar">
                                <img src="{{ url('/images/profile/'.Auth::user()->profile_image) }}" alt="Broken">
                            </div>
                            <div class="wrappers">
                                <div class="file-upload">
                                    <input type="file" name="profile_image" id="img" />
                                    <i class="fa fa-arrow-up" style="font-size: 60px;"></i>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="buttons red unit uplod">
                                <i class="fas fa-upload icn"></i></button>
                        </header>

                        <h3>{{ $user->name }}</h3>

                    </form>
                    <form action="{{ url('/profile/update') }}" method="POST">
                        @method('POST')

                        @csrf

                        <div class="desc">
                            <label for="name">
                                <input type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>
                            </label>

                            <label for="phone">
                                <input type="text" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="phone" autofocus>
                            </label>

                            <label for="email">
                                <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email" autofocus>
                            </label>
                        </div>

                        <button class="buttons red unit" type="submit"><i class="fas fa-lock"></i> Update</button>

                    </form>

                </div>
            </div>



        </div>
    <div class="col-md-3"></div>
</div>

@endsection
<style lang="css/scss">

:root {
    --main-col: #fff000;
    --sec-col: lighten(#303f9f, 20%);
    --back-col: #c5cae9;
    --ruler: 16px;
    --coler-red: #ae1100;
    --color-bg: #ebecf0;
    --color-shadow: #babecc;
    --color-white: #fff;
}

    .py-4 {
        background-color: #ebecf0;
    }

    .cards-container {
        width: 793px;
        max-width: 100%;
    }

    .cardu {
        float: left;
    }

    .card-one {
        position: relative;
        width: 100%;
        background: var(--color-bg);
        box-shadow: 0 10px 7px -5px rgba(#000, 0.4);
    }

    header {
        position: relative;
        width: 100%;
        height: 80px;
        background-color: var(--main-col);
    }

    header::before, header::after {
        content: '';
        position: absolute;
        top: 0;bottom: 0;left: 0;right: 0;
        background: inherit;
    }

    header::before {
        -webkit-transform: skewY(-8deg);
        -moz-transform: skewY(-8deg);
        -ms-transform: skewY(-8deg);
        -o-transform: skewY(-8deg);
        transform: skewY(-8deg);
        -webkit-transform-origin: 100% 100%;
        -moz-transform-origin: 100% 100%;
        -ms-transform-origin: 100% 100%;
        -o-transform-origin: 100% 100%;
        transform-origin: 100% 100%;
    }

    header::after {
        -webkit-transform: skewY(8deg);
        -moz-transform: skewY(8deg);
        -ms-transform: skewY(8deg);
        -o-transform: skewY(8deg);
        transform: skewY(8deg);
        -webkit-transform-origin: 0 100%;
        -moz-transform-origin: 0 100%;
        -ms-transform-origin: 0 100%;
        -o-transform-origin: 0 100%;
        transform-origin: 0 100%;
    }

    .avatar {
        position: absolute;
        left: 44%;
        top: 40px;
        margin-left: -50px;
        z-index: 5;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        overflow: hidden;
        background: #ccc;
        border: 3px solid #fff;
    }

    .avatar img {
        position: absolute;
        top: 50%;
        left:50%;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 165px;
        height: auto;
    }

    h3 {
        position: relative;
        margin: 80px 0 30px;
        text-align: center;
        top: 150px;
        font-size: 35px !important;
        text-transform: capitalize;
    }

    h3::after{
        content: '';
        position:absolute;
        bottom: -15px;
        left: 45%;
        margin-left: -15px;
        width: 100px;
        height: 1px;
        background: #000;
    }

    .desc {
        padding: 0 1rem 2rem;
        text-align: center;
        line-height: 1.5;
        margin-top: 200px;
        color: #777;
    }

    label {
        display: block;
        margin-bottom: 23px;
        width: 100%;
    }

    button, input {
        border: 0;
        outline: 0;
        font-size: 18px;
        color: #9b9dad;
        border-radius: 360px !important;
        padding: 18px 28px;
        background-color: var(--color-bg);
        text-shadow: 1px 1px 0 var(--color-white);
    }

    input {
        font-family: "Montserrat", sans-serif !important;
        letter-spacing: 0.5px;
        margin-right: 18px;
        box-shadow:  inset 2px 2px 5px var(--color-shadow), inset -5px -5px 10px var(--color-white) !important;
        width: 100%;
        box-sizing: border-box;
        transition: all 0.2s ease-in-out;
        appearance: none;
        -webkit-appearance: none;
    }

    input:focus {
        box-shadow:  inset 1px 1px 2px var(--color-shadow), inset -1px -1px 2px var(--color-white);
    }

    label {
        margin: 25px 0;
        flex: 1;
    }

    .buttons {
        color:#61677C;
        font-weight: bold;
        box-shadow: -5px -5px 20px var(--color-white),  5px 5px 20px var(--color-shadow);
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        font-weight: 600;
        width: 90%;
        margin: 0 15px !important;
    }

    .buttons:hover {
        box-shadow: -2px -2px 5px var(--color-white), 2px 2px 5px var(--color-shadow);
    }

    .buttons:active {
        box-shadow: inset 1px 1px 2px var(--color-shadow), inset -1px -1px 2px var(--color-white);
    }

    .icon {
        margin-right: 9px;
    }

    .unit {
        border-radius: 9px;
        line-height: 0;
        width: 90%;
        height: 54px;
        display:inline-flex;
        justify-content: center;
        align-items:center;
        margin: 0 15px;
        font-size: 18px;
    }

    .icon {
        margin-right: 0;
    }

    .icn {
        position: absolute;
        top: 15px;
        left: 20px;
    }

    .red {
        display: block;
        color: #ae1100;
    }

    .wrappers {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .wrappers .file-upload {
        height: 80px;
        width: 80px;
        top: 150px;
        left: 70px;
        border-radius: 100px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 4px solid #FFFFFF;
        overflow: hidden;
        background-image: linear-gradient(to bottom, #2590EB 50%, #FFFFFF 50%);
        background-size: 100% 200%;
        transition: all 1s;
        color: #FFFFFF;
        cursor: pointer;
        font-size: 100px;
    }
    .wrappers .file-upload input[type=file] {
        height: 100px;
        width: 100px;
        position: absolute;
        top: -15px;
        left: 0px;
        opacity: 0;
        padding: 100px;
        cursor: pointer;
    }
    .wrappers .file-upload:hover {
        background-position: 0 -100%;
        color: #2590EB;
    }

    .file-upload{
        height:40px;
        width:40px;
        border-radius: 100px;
        position:relative;

        display:flex;
        justify-content:center;
        align-items: center;

        border:4px solid #FFFFFF;
        overflow:hidden;
        background-image: linear-gradient(to bottom, #2590EB 50%, #FFFFFF 50%);
        background-size: 100% 200%;
        transition: all 1s;
        color: #FFFFFF;
        font-size:100px;
        z-index: 6;
    }

    input[type='file']{
        height:200px;
        width:200px;
        position:absolute;
        top:0;
        left:0;
        opacity:0;
        cursor:pointer;
    }

    input:hover{
        background-position: 0 -100%;
        color:#2590EB;
    }

    .uplod {
        position: relative;
        top: 100px;
        left: 80%;
        width: 50px;
    }




    /* .img-divs{
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
        } */
</style>
