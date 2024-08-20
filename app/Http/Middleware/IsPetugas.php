<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsPetugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {

            if (Auth::guard('admin')->user()->level == 'petugas') {
                return $next($request);
            }else if(Auth::guard('admin')->user()->level == 'admin'){
                return $next($request);
            }
        }

        return redirect()->route('admin.formLogin');
    }
}




