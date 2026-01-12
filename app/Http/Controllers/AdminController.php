<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use View;
class AdminController extends Controller
{
    //

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function AdminLogIn(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $verificationCode = random_int(100000, 999999);

            session(['verification_Code' => $verificationCode, 'user_id' => $user->id]);

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            Auth::logout();

            return redirect()->route('custom.verification.form')->with('status', 'Verification code send to your mail');

        }

        return redirect()->back()->withErrors(['email' => 'Invaild Credentials Provided']);
    }

    public function ShowVerification()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        return view('auth.verify');
    }

    public function VerificationVerify(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        if ($request->code == session('verification_Code')) {
            Auth::loginUsingId(session('user_id'));

            session()->forget(['verification_Code', 'user_id']);
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors(['code' => 'Invalid Verification Code']);

    }

    public function AdminProfile()
    {
        return view('admin.admin_profile');
    }
}
