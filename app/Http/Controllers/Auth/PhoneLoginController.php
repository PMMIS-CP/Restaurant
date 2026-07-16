<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PhoneLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone'    => 'required|regex:/^09[0-9]{9}$/',
            'password' => 'required|string',
        ]);

        if (Auth::guard('web')->attempt([
            'phone'    => $request->phone,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            $redirect = redirect()->intended(route('dashboard'))->getTargetUrl();
            return response()->json(['redirect' => $redirect]);
        }

        throw ValidationException::withMessages([
            'phone' => 'شماره موبایل یا رمز عبور اشتباه است.',
        ]);
    }
}