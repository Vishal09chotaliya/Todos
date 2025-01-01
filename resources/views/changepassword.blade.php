<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        .change-password-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #555555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333333;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="password"]:focus {
            border-color: #007bff;
        }

        .btn-submit {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        #msg{
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Change Password</h1>
        <form method="post" class="change-password-form">
            @csrf
            <div class="form-group">
                <label for="new-password">New Password:</label>
                <input type="password" id="password" name="new-password" placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password">
            </div>
            <button class="btn-submit" id="change">Update Password</button><br>
            <div id="msg"><a href="{{ route('logout') }}">Click to Login Here Again.</a></div>
        </form>
    </div>

    @include('jquery')
    <script>
        $(document).ready(function() {
            $('#change').on('click', function(e) {
                e.preventDefault();
                var password = $('#password').val();
                var confirm_password = $('#confirm-password').val();

                if (password == '' || confirm_password == '') {
                    alert('Please Fill the All Fields.');
                } else {
                    if (password != confirm_password) {
                        alert('Password or Confirm Password does not match');
                    }
                    $.ajax({
                        url: "{{ route('change.pass') }}",
                        type: 'POST',
                        data: {
                            password : password
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert(response.message);
                            $('#msg').show('slow');
                        }
                    });
                }

            });
        });
    </script>

</body>

</html>
