<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
 
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if(Auth::check()){
            return $response;
        }else{
            return redirect()->route('welcome'); 
        }
    }
}
