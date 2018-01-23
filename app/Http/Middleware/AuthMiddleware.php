<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Проверяет авторизован ли пользователь если авторизован то ништяк если нет то по всем маршрутам возвращать 404
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::check() && Auth::user()->status){
            return $next($request);
        }
        abort(404);

        return $next($request);
    }
}
