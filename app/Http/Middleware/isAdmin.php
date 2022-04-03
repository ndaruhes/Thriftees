<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        return ($user && $user->role == 'Admin') ?  $next($request) : redirect()->route('allBarang');
    }
}
