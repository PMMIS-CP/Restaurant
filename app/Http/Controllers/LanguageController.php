<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (in_array($lang, ['en', 'fa', 'ar'])) {
            session(['locale' => $lang]);

            if (auth()->check()) {
                auth()->user()->update(['locale' => $lang]);
            }
        }

        return redirect()->back();
    }
}
