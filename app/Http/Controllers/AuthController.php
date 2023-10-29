<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

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
            'email'=>['required','email','unique:users']
        ]);
        return back()->with('success','Successfully sent message');
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
