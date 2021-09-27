<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'es';
     //   app()->setLocale($local);
        App::setLocale($locale);

        return $next($request);
    }
}
