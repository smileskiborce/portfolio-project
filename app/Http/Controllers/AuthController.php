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
            'username' => 'Внесовте неточно корисничко име или лозинка.',
        ])->onlyInput('email');
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
