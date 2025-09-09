<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    // app/Http/Middleware/SetLocale.php
    public function handle($request, Closure $next){
        $locale = auth()->user()->locale
                ?? session('locale')
                ?? config('app.locale');
        app()->setLocale($locale);
        return $next($request);
    }
}
