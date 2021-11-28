<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'),)
        ]);
        Auth::login($user);
        $token = $user->createToken('myapp')->plainTextToken;
        return response()->json([
            'data' => $user,
            'token' => $token,
            'message' => 'Đăng ký thành công',
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->only(['remember']);

        if (!User::where('email', $request->input('email'))->first()) {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin đăng nhập sai. Vui lòng kiểm tra lại.',
                'errors' => [
                    'email' => __('validation.email_not_found')
                ]
            ]);
        }

        if (Auth::attempt($credentials, $remember)) {
            return response()->json([
                'data' => Auth::user(),
                'token' => Auth::user()->createToken('myapp')->plainTextToken,
                'success' => true,
                'message' => 'Đăng nhập thành công'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Thông tin đăng nhập sai. Vui lòng kiểm tra lại.',
            'errors' => [
                'password' => 'Mật khẩu không đúng.'
            ]
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đăng xuất thành công'
        ]);
    }
}
