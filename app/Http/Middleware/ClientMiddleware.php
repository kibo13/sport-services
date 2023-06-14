<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isClient()) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
