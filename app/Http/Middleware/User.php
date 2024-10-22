<?php

namespace App\Http\Middleware;

use Closure;

class User
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
        if (empty(session('user'))) {
            session()->flash('showLoginModal', true);
            return redirect()->route('user.order.index');
        } else {
            return $next($request);
        }
    }
}
