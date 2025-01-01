<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            min-width: 1000px;
            overflow: auto;
            line-height: 1.6;
            margin: 50px auto;
            width: 70%;
            padding: 20px 0;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            border-bottom: 1px solid #212529;
            padding-bottom: 10px;
        }
        .header a {
            font-size: 1.4em;
            color: #000000;
            text-decoration: none;
            font-weight: 600;
        }
        .otp {
            background: #007bff;
            width: max-content;
            padding: 10px;
            color: #FFFFFF;
            border-radius: 4px;
            font-size: 1.5em;
            margin: 20px 0;
        }
        .footer {
            font-size: 0.9em;
            color: #6c757d;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="header">
        <a href="#">Andropedia</a>
    </div>
    <p>Hi,</p>
    <h2 class="otp">{{ $otp }}</h2>
    <p>Please note that this OTP expires within 5 minutes. After 5 minutes, you must submit a new request.<br>
        For your security, do not share this OTP with anyone.</p>
    <p class="footer">Thank You & Best Regards,<br/>
       Andropedia</p>
</div>
</body>

</html>
