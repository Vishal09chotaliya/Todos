<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\WelcomeMail;


class AuthController extends Controller
{
    //With Google Login 

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleHandle()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('googleid', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('dashbord');

            } else {
                $newUser = User::create([
                    'user_name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt('123456'),
                    'googleid' => $user->id,
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashbord');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    //Normal Login and Register

    public function Register(CreateUser $request)
    {
        $data = [
            'user_name' => $request->uname,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        $user = User::create($data);

        $this->sendRegistrationEmail($data);

        return response()->json($user);
    }
    protected function sendRegistrationEmail($data)
    {
        Mail::send('Welcomemail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('Registration Successful');
        });
    }

    public function Login(request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json('1');
        } else {
            return response()->json('0');
        }
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    //Forgot Password using Email vsrificstion code(OTP)

    public function forgot()
    {
        return view('forgot');
    }


    public function changePassword()
    {
        return view('changepassword');
    }

    public function changehere(request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:4',
        ]);

        $email = Auth::user()->email;

        $user = User::where('email', $email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);

    }

    public function forgotOtp()
    {
        return view('forgotchange');
    }

    public function forgotPassword(request $request)
    {

        $validated = $request->validate([
            'password' => 'required|min:4',
        ]);

        $email = session('email');

        $user = User::where('email', $email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

}

