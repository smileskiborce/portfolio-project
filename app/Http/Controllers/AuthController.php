<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordRequest;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Inertia\Response;
use function Symfony\Component\Translation\t;

class AuthController extends Controller
{
    public function showLogin(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function showRegister(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function login(Request $request): RedirectResponse
    {
        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();
            $user = auth()->user();
            $user->last_login = Carbon::now();
            $user->save();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'username' => 'You entered an incorrect username or password.',
        ])->onlyInput('email');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users']
        ]);
        $user = new User(['email' => $request->email]);
        $user->save();
        $token = Str::random(64);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Mail::send('emails\emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        return back()->with('success', 'Successfully sent message to your mail to verify your account');
    }

    public function verifyAccount($token): RedirectResponse
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                return redirect()->route('user.set_password', ['user' => $verifyUser->user]);
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }


    public function setPassword(User $user)
    {
        return Inertia::render('Auth/Password', compact('user'));
    }

    public function setPasswordVerified(User $user, UserPasswordRequest $request): RedirectResponse
    {
        $user->update($request->validated());
        $user->save();
        return redirect()->route('show_login')->with('success','Successfully updated account');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->remove('last_activity');

        return redirect()->route('show_login');
    }
}
