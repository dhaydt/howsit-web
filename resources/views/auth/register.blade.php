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
                <header>{{ __('Register') }}</header>

                <div class="container mt-2" style="position: absolute; top: 20%; left: 1%;">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" style="background-color: transparent; border: none; color:red;">{{ $error }}</div>
                    @endforeach
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                </div>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="field">
                        <span class="fa fa-user"></span>

                        <input id="name" style="background-color: azure; padding-left: 20px; border-radius: 10px;" type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="{{ __(' Your Name') }}" required autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field space">
                        <span class="fa fa-envelope"></span>
                        <input id="email" style="background-color: azure;" type="email" class="@error('email') is-invalid @enderror" name="email" placeholder="{{ __(' E-Mail Address') }}" required_without:phone autocomplete="email">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field space">
                        <span class="fa fa-phone"></span>
                        <input id="phone" style="background-color: azure; border-radius: 10px; padding-left: 20px;" type="text" class="@error('phone') is-invalid @enderror" name="phone" placeholder="{{ __(' Phone Number') }}" required_without:email autocomplete="phone">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field space">
                        <span class="fa fa-lock"></span>
                        <input id="password" style="background-color: azure;" type="password" class="pass-key @error('password') is-invalid @enderror" name="password" placeholder="{{ __(' Create Password') }}" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field space">
                        <span class="fa fa-lock"></span>
                        <input id="password-confirm" style="background-color: azure; padding-left: 20px; border-radius: 10px;" type="password" class="pass-key" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                    </div>

                    <div hidden>
                        <input type="text" name="profile_image" value="profile.png">
                    </div>



                    <div class="field space">
                        <input type="submit" value="{{ __('Register') }}">
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
            <div class="signup space">Already have account?
            <a href="{{ route('login') }}">Login Now</a>
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


    </body>
</html>
