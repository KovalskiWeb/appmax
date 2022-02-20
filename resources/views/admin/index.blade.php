<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Appmax - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('backend/assets/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/ajax_message.css') }}">
    <!--===============================================================================================-->

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="ajax_response"></div>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form name="login" action="{{ route('admin.login.do') }}" method="post" class="login100-form validate-form" autocomplete="off">
                    <span class="login100-form-title p-b-49">
                        AppMax
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Insira seu e-mail!">
                        <span class="label-input100">E-mail</span>
                        <input type="email" class="input100" type="text" name="email" placeholder="Insira seu e-mail">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Insira sua senha!">
                        <span class="label-input100">Senha</span>
                        <input class="input100" type="password" name="password_check" placeholder="Insira sua senha">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="container-login100-form-btn mt-5">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('backend/assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend/assets/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    {{-- <script src="{{ asset('backend/assets/vendor/select2/select2.min.js') }}"></script> --}}
    <!--===============================================================================================-->
    {{-- <script src="{{ asset('backend/assets/vendor/daterangepicker/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/assets/vendor/daterangepicker/daterangepicker.js') }}"></script> --}}
    <!--===============================================================================================-->
    {{-- <script src="{{ asset('backend/assets/vendor/countdowntime/countdowntime.js') }}"></script> --}}
    <!--===============================================================================================-->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom_scripts.js') }}"></script>

</body>

</html>
