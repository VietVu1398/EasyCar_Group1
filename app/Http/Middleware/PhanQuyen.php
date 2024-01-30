<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class PhanQuyen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {   
        if(Auth::check()){
            if(Auth::user()->role_value==0 || Auth::user()->role_value==1){
                return $next($request);
            }else{
                return redirect()->route('fe.home');
            }
        }else{
            return redirect()->route('fe.login');
        }//check login
    }
}
