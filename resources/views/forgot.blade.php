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
            cursor: pointer;
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
            cursor: pointer;

        }

        .login-button{
            box-sizing: border-box;
            color: white;
            font-size: 14px;
            padding: 13px;
            border-radius: 7px;
            border: none;
            width: 150px;
            outline: none;
            background-color: rgb(56, 102, 189);
            cursor: pointer;
        }

        #otp-btn:disabled {
            background-color: #cccccc;
            color: #666666;
            border: 1px solid #999999;
            cursor: not-allowed;
            opacity: 0.6;
        }

        #email-forgot:disabled {
            background-color: #cccccc;
            color: #666666;
            border: 1px solid #999999;
            cursor: not-allowed;
            opacity: 0.6;
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
        <!--Forms-->
        <div class="box-2">
            <div class="login-form-container">
                <h1>Forgot Password</h1>
                <div class="send-otp">
                    <form method="post" id="send-otp">
                        @csrf
                        <input type="email" placeholder="Email" class="input-field" id="email-forgot" name="email">
                        <button class="otp-button" id="otp-btn">Send Otp</button>
                    </form>
                </div>
                <br><br>
                <form action="#" method="post" id='verify-otp'>
                    @csrf
                    <div>
                        <input type="text" placeholder="OTP" class="input-field" id="otp" name="otp">
                        <br><br>
                        <button class="login-button" type="submit" id="login-btn">Verify Otp</button>
                        <br><br>
                    </div>
                </form>
                <a href="{{ route('welcome') }}">Back to Login</a>
            </div>

        </div>
        @include('jquery')
        <script>
            $(document).ready(function() {
                $(document).ready(function() {
                    $('#send-otp').on('submit', function(e) {
                        e.preventDefault();

                        const email = $('#email-forgot').val();

                        if (!validateEmail(email)) {
                            alert('Please enter a valid email address.');
                            return;
                        }

                        $.ajax({
                            url: '{{ route('sentOtp') }}',
                            type: 'POST',
                            data: {
                                email: email
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alert('OTP sent successfully!');
                                $('#verify-otp').show('slow');
                                $('#email-forgot').prop('disabled', true);
                                $('.otp-button').prop('disabled', true);
                            },
                            error: function(xhr, status, error) {
                                alert('Email Address Does not Exist.');
                                console.error(error);
                            }
                        });
                    });


                    // Simple email validation function
                    function validateEmail(email) {
                        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        return re.test(email);
                    }
                });

                $('#verify-otp').on('submit', function(e) {
                    e.preventDefault();

                    const otp = $('#otp').val();

                    $.ajax({
                        url: '{{ route('verifyOtp') }}',
                        type: 'POST',
                        data: {
                            otp: otp
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            window.location.href = "{{ route('forgot.chage') }}";
                        },
                        error: function(xhr) {
                            if (xhr.status === 400) {
                                alert(xhr.responseJSON.message);
                            } else {
                                alert('An unexpected error occurred. Please try again.');
                            }
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
</body>

</html>
