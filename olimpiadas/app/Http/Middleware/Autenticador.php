<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $acesso = null): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $nivel = Auth::user()->nivelAcesso;
        if($nivel == 2) {
            return $next($request);
        }
        // dd($nivel);
        if($acesso != 'admin') {
            if($nivel < 1) {
                return back();
            } else {
                // dd($acesso, $nivel);
                return $next($request);
            }
        }
        return back();
    }
}
