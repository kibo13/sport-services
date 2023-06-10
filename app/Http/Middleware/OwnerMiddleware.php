<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isOwner()) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
