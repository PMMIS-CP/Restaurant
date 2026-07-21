<?php

namespace App\Http\Middleware\OptimizeResponse;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddSecurityHeaders
{
    protected array $securityHeaders = [
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'SAMEORIGIN',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Permissions-Policy' => 'geolocation=(), microphone=(), camera=(), payment=()',
        'Cross-Origin-Opener-Policy' => 'same-origin',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (config('app.show_powered_by') === false) {
            $response->headers->remove('X-Powered-By');
        }

        // $response->headers->remove('Server');

        foreach ($this->securityHeaders as $key => $value) {
            if (!$response->headers->has($key)) {
                $response->headers->set($key, $value);
            }
        }

        if (config('app.enable_csp', false)) {
            $csp = "default-src 'self'; " .
                   "script-src 'self'; " . 
                   "style-src 'self' 'unsafe-inline'; " . 
                   "img-src 'self' data: https:; " .
                   "connect-src 'self'; " .
                   "frame-ancestors 'self'; " .
                   "object-src 'none';";
            $response->headers->set('Content-Security-Policy', $csp);
        }

        if (config('app.enable_hsts', false) && config('app.env') === 'production') {
            $hstsValue = 'max-age=604800';
            $response->headers->set('Strict-Transport-Security', $hstsValue);
        }

        return $response;
    }
}