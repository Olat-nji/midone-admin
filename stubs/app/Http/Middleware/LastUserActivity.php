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
            $redis = Redis::connection();
            $some_unique_key = 'user:' . auth()->user()->id . ':online';
            if (!$redis->exists($some_unique_key)) {
                //set the key
                $redis->set($some_unique_key, true);
                //set the expiration
                //I understand this means expire in 60s.
                $redis->expire($some_unique_key, 60);
            }
            // Redis::set('user:' . auth()->user()->id . ':online', 'true', 'PX', 60);
        }
        return $next($request);
    }
}
