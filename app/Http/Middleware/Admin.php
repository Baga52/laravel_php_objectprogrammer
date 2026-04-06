<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PHPUnit\Event\Facade;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
        if (auth()->user()->isAdmin() === true){
            return $next($request);
        }
    }
    return redirect('login')->with('error', 'Авторизуйтесь под администратором');;
    }
}
