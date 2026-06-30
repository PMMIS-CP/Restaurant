<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // بررسی اینکه زبان ارسالی حتما fa یا en باشد
        if (in_array($lang, ['en', 'fa'])) {
            // ذخیره در سشن
            session(['locale' => $lang]);
            
            // ذخیره در دیتابیس اگر کاربر لاگین است
            if (auth()->check()) {
                auth()->user()->update(['locale' => $lang]);
            }
        }
        return back();
    }
}
