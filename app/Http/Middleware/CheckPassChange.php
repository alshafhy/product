<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPassChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeExceptioArray = ['change-password','update-password','home-page'];
        if(auth()){
            // dd(Route::current()->getName());
            // dd(auth()->user()->pass_need_to_be_changed);
            // if (currentRoute === 'some_url') {
            //     return $next($request);
            // }
            if(auth()->user() && auth()->user()->pass_need_to_be_changed && ! in_array(Route::current()->getName(), $routeExceptioArray) ){
                return redirect(route('change-password'));
            }
        }
        return $next($request);
    }
}
