<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->locale) {
            app()->setLocale(auth()->user()->locale);
        } elseif (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        }

        // تنظیم direction بر اساس زبان
        $rtlLocales = ['fa', 'ar'];
        $locale = app()->getLocale();
        
        if (in_array($locale, $rtlLocales)) {
            session(['dir' => 'rtl']);
        } else {
            session(['dir' => 'ltr']);
        }

        return $next($request);
    }
}
