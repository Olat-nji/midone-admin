<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class LastUserActivity
{
/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @return mixed
 */
public function handle(Request $request, Closure $next)
{
    if (Auth::check()) {

        $some_unique_key = 'user:' . auth()->user()->id . ':online';
        Cache::add($some_unique_key, true, 60);
    }
    return $next($request);
}
}
