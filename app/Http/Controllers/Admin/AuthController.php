<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->only(['remember']);

        if (!Admin::where('email', $request->input('email'))->first()) {
            return back()->withInput()->withErrors([
                'email' => __('validation.email_not_found'),
            ]);
        }

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('admin.index');
        }

        return back()->withInput()->withErrors([
            'password' => __('validation.password_invalid'),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.getLogin');
    }
}
