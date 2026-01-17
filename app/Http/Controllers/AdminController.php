<?php

namespace App\Http\Controllers;

use App\Models\usability;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    public function ProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::findOrFail($id);

        $profileData->name = $request->name;
        $profileData->email = $request->email;
        $profileData->phone = $request->phone;
        $profileData->address = $request->address;

        $oldPath = public_path('uploads/' . $profileData->photo);


        if ($request->hasFile('photo')) {
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads'), $imageName);
            $profileData->photo = $imageName;
        }

        $profileData->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PasswordUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            $notification = array(
                'message' => 'Old Password does not Match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($notification);
    }
}
