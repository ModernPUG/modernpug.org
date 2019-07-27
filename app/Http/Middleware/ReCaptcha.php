<?php

namespace App\Http\Middleware;

use Closure;

class ReCaptcha
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
        $request->validate([
            config('recaptcha.validation-key') => 'required|recaptcha',
        ]);

        return $next($request);
    }
}
