<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Howsit Web</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.3.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
    <body>
        <div class="bg-img" id="app">
            <div class="content">
                <div class="logo">
                    <div class="rounded">
                        <div class="logo-img"></div>
                    </div>
                </div>
                <header>{{ __('Login Pages') }}</header>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field">
                        <span class="fa fa-user"></span>
                        <input id="email" type="email" style="background-color: azure;" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field space">
                        <span class="fa fa-lock"></span>
                        <input id="password" type="password" style="background-color: azure;" class="pass-key @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <!-- <span class="show">SHOW</span> -->

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="pass">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <div class="field">
                        <input type="submit" value="{{ __('Login') }}">
                    </div>
                </form>
            <!-- <div class="login">Or login with</div>
            <div class="links">
            <div class="facebook">
                <i class="fab fa-facebook-f"><span>Facebook</span></i>
            </div>
            <div class="instagram">
                <i class="fab fa-instagram"><span>Instagram</span></i>
            </div>
            </div> -->
            <div class="signup">Don't have account?
            <a href="{{ route('register') }}">Signup Now</a>
            </div>
        </div>
        </div>

        <script>
        //     const pass_field = document.querySelector('.pass-key');
        //     const showBtn = document.querySelector('.show');
        //     showBtn.addEventListener('click', function(){
        //     if(pass_field.type === "password"){
        //         pass_field.type = "text";
        //         showBtn.textContent = "HIDE";
        //         showBtn.style.color = "#3498db";
        //     }else{
        //         pass_field.type = "password";
        //         showBtn.textContent = "SHOW";
        //         showBtn.style.color = "#222";
        //     }
        //     }
        // );
    </script>
    <style>
        .field input[type="submit"] {
            border-radius: 0;
        }
    </style>

    </body>
</html>
