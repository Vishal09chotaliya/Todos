<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Welcome to sign In | Sign Up</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            overflow: hidden;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            background-color: red;
            background: linear-gradient(to bottom, rgb(6, 108, 100), rgb(14, 48, 122));
            width: 800px;
            height: 400px;
            margin: 10% auto;
            border-radius: 5px;
        }

        .content-holder {
            text-align: center;
            color: white;
            font-size: 14px;
            font-weight: lighter;
            letter-spacing: 2px;
            margin-top: 15%;
            padding: 50px;
        }

        .content-holder h2 {
            font-size: 34px;
            margin: 20px auto;
        }

        .content-holder p {
            margin: 30px auto;
        }

        .content-holder button {
            border: none;
            font-size: 15px;
            padding: 10px;
            border-radius: 6px;
            background-color: white;
            width: 150px;
            margin: 20px auto;
        }


        .box-2 {
            background-color: white;
            margin: 5px;
        }

        .login-form-container {
            text-align: center;
            margin-top: 10%;

        }

        .login-form-container h1 {
            color: black;
            font-size: 24px;
            padding: 20px;
        }

        .input-field {
            box-sizing: border-box;
            font-size: 14px;
            padding: 10px;
            border-radius: 7px;
            border: 1px solid rgb(168, 168, 168);
            width: 250px;
            outline: none;
        }

        .login-button {
            box-sizing: border-box;
            color: white;
            font-size: 14px;
            padding: 13px;
            border-radius: 7px;
            border: none;
            width: 250px;
            outline: none;
            background-color: rgb(56, 102, 189);
            cursor: pointer;
        }

        .button-2 {
            display: none;
            cursor: pointer;
        }

        .button-1 {
            cursor: pointer;
        }

        .signup-form-container {
            position: relative;
            top: 200px;
            left: 50%;
            transform: translate(-50%, -60%);
            text-align: center;
            display: none;
        }


        .signup-form-container h1 {
            color: black;
            font-size: 24px;
            padding: 20px;
        }

        .signup-button {
            box-sizing: border-box;
            color: white;
            font-size: 14px;
            padding: 13px;
            border-radius: 7px;
            border: none;
            width: 250px;
            outline: none;
            background-color: rgb(56, 189, 149);
            cursor: pointer;
        }

        #msg,
        #login-message {
            color: rgb(96, 99, 98);
        }

        #error,
        #login-error {
            color: red;
        }

        .social-login {
            display: flex;
            justify-content: space-around;
            /* flex-direction: column; */
            gap: 10px;
            width: 100%;
            max-width: 500px;
            /* margin-left: 50px; */
        }

        .google-btn,
        .facebook-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .google-btn {
            background-color: #db4437;
            color: white;
        }

        .google-btn a {
            text-decoration: none;
            color: white;
        }

        .google-btn:hover {
            background-color: #c23321;
        }

        .facebook-btn a {
            text-decoration: none;
            color: white;
        }

        .facebook-btn {
            background-color: #4267B2;
            color: white;
        }

        .facebook-btn:hover {
            background-color: #365899;
        }

        .google-btn i,
        .facebook-btn i {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!--Data or Content-->
        <div class="box-1">
            <div class="content-holder">
                <h2>Welcome!</h2>
                <button class="button-1" onclick="signup()">Sign up</button>
                <button class="button-2" onclick="login()">Login</button>
            </div>
        </div>
        <!--Forms-->
        <div class="box-2">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="login-form-container">
                    <h1>Login Now.</h1>
                    <input type="email" placeholder="Email" class="input-field" id="login-email" name="email">
                    <br><br>
                    <input type="password" placeholder="Password" class="input-field" id="login-password"
                        name="password">
                    <br><br>
                    <button class="login-button" type="submit" id="login-btn">Login</button><br><br>
                    <a href="{{ route('forgot') }}">Forgot Password</a>
                    <br><br>
                    <span id="login-error"></span>
                    <span id="login-message"></span>

                    <div class="social-login">
                        <button class="google-btn">
                            <a href="{{ URL::To('googlelogin') }}">
                                <i class="fab fa-google"></i> Login with Google
                            </a>
                        </button>
                    </div>
                </div>
            </form>
            <!--Create Container for Signup form-->
            <form id="form">
                @csrf
                <div class="signup-form-container">
                    <h1>Sign Up Form</h1>
                    <input type="text" placeholder="Username" class="input-field" name="uname" id="uname">
                    <br><br>
                    <input type="email" placeholder="Email" class="input-field" name="email" id="email">
                    <br><br>
                    <input type="password" placeholder="Password" class="input-field" name="password" id="password">
                    <br><br>
                    <input type="password" placeholder="Confirm Password" class="input-field"
                        name="password_confirmation" id="cpassword">
                    <br><br>
                    <button class="signup-button" type="submit" id="submit">Sign Up</button><br><br>
                    <span id="msg"></span>
                    <span id="error"></span>
                </div>
            </form>
        </div>
        @include('jquery')
        <script>
            function signup() {
                document.querySelector(".login-form-container").style.cssText = "display: none;";
                document.querySelector(".signup-form-container").style.cssText = "display: block;";
                document.querySelector(".container").style.cssText =
                    "background: linear-gradient(to bottom, rgb(56, 189, 149),  rgb(28, 139, 106));";
                document.querySelector(".button-1").style.cssText = "display: none";
                document.querySelector(".button-2").style.cssText = "display: block";
            };

            function login() {
                document.querySelector(".signup-form-container").style.cssText = "display: none;";
                document.querySelector(".login-form-container").style.cssText = "display: block;";
                document.querySelector(".container").style.cssText =
                    "background: linear-gradient(to bottom, rgb(6, 108, 224),  rgb(14, 48, 122));";
                document.querySelector(".button-2").style.cssText = "display: none";
                document.querySelector(".button-1").style.cssText = "display: block";

            }

            $(document).ready(function() {

                $('#submit').on('click', function(e) {
                    e.preventDefault();
                    var username = $('#uname').val();
                    var email = $('#email').val();
                    var password = $('#password').val();
                    var password_confirm = $('#cpassword').val();
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (username == '' || email == '' || password == '' || password_confirm == '') {
                        $('#error').html('Please Fill The All Fields..');
                        setTimeout(function() {
                            $('#error').slideUp('slow');
                        }, 6000);
                    } else if (password !== password_confirm) {
                        $('#error').html('Password Does Not Match..');
                        setTimeout(function() {
                            $('#error').slideUp('slow');
                        }, 6000);
                    } else if (!emailRegex.test(email)) {
                        $('#error').html('Please Enter Valid Email Address..');
                        setTimeout(function() {
                            $('#error').slideUp('slow');
                        }, 6000);
                    } else {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/register",
                            type: 'POST',
                            data: {
                                uname: username,
                                email: email,
                                password: password
                            },
                            success: function(result) {
                                $('#form input').val('');
                                $('#msg').html('Thank You For Register.!');
                                setTimeout(function() {
                                    $('#msg').slideUp('slow');
                                }, 3000);
                            }
                        });
                    }
                });

                // login
                $('#login-btn').on('click', function(e) {
                    e.preventDefault();
                    var email = $('#login-email').val();
                    var password = $('#login-password').val();
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (email == '' || password == '') {
                        $('#login-error').html('Please Fill The All Fields..');
                        setTimeout(function() {
                             $('#login-error').slideUp('slow');
                        }, 6000);
                    } else if (!emailRegex.test(email)) {
                        $('#login-error').html('Please Enter Valid Email Address..');
                        setTimeout(function() {
                            $('#login-error').slideUp('slow');
                        }, 6000);
                    } else {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/login",
                            method: "POST",
                            data: {
                                email: email,
                                password: password
                            },
                            success: function(response) {
                                if (response == '1') {
                                    window.location.href = '/dashbord';
                                } else {
                                    $('#login-error').html('Email and Password are incorrect..');
                                    setTimeout(function() {
                                        $('#login-error').slideUp('slow');
                                    }, 6000);
                                }
                            }
                        });

                    }
                });
            });
        </script>
</body>

</html>
