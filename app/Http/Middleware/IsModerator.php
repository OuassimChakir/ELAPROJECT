<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IsModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // is not Moderator
        if(is_null(session()->get('user')->codeRole) || (session()->get('user')->codeRole != '00' && session()->get('user')->codeRole != '11')){
            return Redirect::back()->with('deleteMessage','Accès refusé!');
        }
        return $next($request);
    }
}
