<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class PostsWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user=Auth::user();
            if($user->hasRole('Manager') || $user->hasRole('PostsWriter')){
                return $next($request);
            }else{
                return redirect(url('/'));
            }
        }else{
            return redirect(url('/users/login'));
        }
        return $next($request);
    }
}
