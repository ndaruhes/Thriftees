<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isMember
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        return ($user && $user->role == 'Member') ?  $next($request) : abort(404);
    }
}
