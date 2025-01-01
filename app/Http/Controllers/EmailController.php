<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendOtp;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordEmail;

class EmailController extends Controller
{
    public function sentOtp(SendOtp $request)
    {
        $data = $request->email;
        $otp = random_int(100000, 999999);

        session(['email' => $data]);

        session(['otp' => $otp, 'otp_email' => $data]);
        sleep(1);
        Mail::to($data)->send(new ForgotPasswordEmail($otp));
        sleep(1);
        return response()->json(['success' => 'OTP sent successfully to ' . $data], 200);
    }

    public function verifyOtp(Request $request)
    {
        $data = $request->otp;
        if ((string) session('otp') === (string) $data) {

            return response()->json(['message' => 'OTP verification successful!'], 200);
        } else {
            return response()->json(['message' => 'Failed To Verify Otp .'], 400);
        }
    }

 

}

