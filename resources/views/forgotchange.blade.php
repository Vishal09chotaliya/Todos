<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            height: 350px;
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
            margin: 10px auto;
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
        }

        #msg,
        #login-message {
            color: rgb(96, 99, 98);
        }

        #error,
        #login-error {
            color: red;
        }

        #verify-otp {
            display: none;
        }

        .send-otp {
            display: flex;
            margin: auto;
            margin-left: 30px;
        }

        .send-otp input {
            margin-right: 10px;
        }

        .otp-button {
            box-sizing: border-box;
            color: white;
            font-size: 14px;
            padding: 13px;
            border-radius: 7px;
            border: none;
            width: 150px;
            outline: none;
            background-color: rgb(56, 102, 189);

        }

        #otp-btn:disabled {
            background-color: #cccccc;
            color: #666666;
            border: 1px solid #999999;
            cursor: not-allowed;
            opacity: 0.6;
        }

        #email:disabled {
            background-color: #cccccc;
            color: #666666;
            border: 1px solid #999999;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .send-otp {
            dsplay: flex;
            flex-direction: column;
            margin-left: 25%;
        }

        .send-otp input,
        #otp-btn {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!--Data or Content-->
        <div class="box-1">
            <div class="content-holder">
                <h2>Forgot Password!</h2>

            </div>
        </div>
        <div class="box-2">
            <div class="login-form-container">
                <h1>Forgot Password</h1>
                <form id="changepass" method="post">
                    @csrf
                    <div class="send-otp">
                        <input type="password" placeholder="Enter New Password" class="input-field" id="psw"
                            name="email">
                        <input type="password" placeholder="Enter New Password Again" class="input-field" id="c-psw"
                            name="email">
                        <button class="otp-button" id="change-btn">Change Password</button>
                    </div>
                </form>
                <br><br>

                <a href="{{ route('welcome') }}">Back to Login</a>
            </div>

        </div>
        @include('jquery')
        <script>
            $(document).ready(function() {
                $('#changepass').on('submit', function(e) {
                    e.preventDefault();

                    var password = $('#psw').val();
                    var confirm = $('#c-psw').val();
                    
                    if(password == '' || confirm == ''){
                        alert('please enter the all fields..');
                    }
                    else{
                        if(password != confirm){
                            alert('Confirm Password are Dosent Match.');
                        }
                        $.ajax({
                            url: '{{ route("change.Password") }}',
                            type: 'POST',
                            data: {
                                password: password
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alert(response.message + ' Go and Login Now.');
                                window.location.href = '/';
                            }
                        });
                    }
                });
            });
        </script>
</body>

</html>
