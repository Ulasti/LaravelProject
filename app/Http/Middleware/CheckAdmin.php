<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->hasRole('admin')) {
            return redirect()->route('user.home')
                ->with('error', 'You do not have admin access.');
        }

        return $next($request);
    }
}
