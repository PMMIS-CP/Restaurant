<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthenticatedSessionController extends Controller
{
    /**
     * نمایش فرم ورود ادمین
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * پردازش درخواست ورود
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Destroy an authenticated session.
     * 
     * TODO: Currently invalidating the web session also logs out admin 
     * if both are logged in on the same browser. This is acceptable for now
     * since admins and regular users don't share sessions in practice.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}