<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Giriş yapılmamışsa login'e yönlendir
        if (!auth()->check()) {
            return redirect()->route('admin.login')
                             ->with('error', 'Bu sayfaya erişmek için giriş yapmanız gerekiyor.');
        }

        return $next($request);
    }
}
