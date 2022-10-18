<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IsAdmin
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
        // Is not Admin
        if(is_null(session()->get('user')->codeRole) || session()->get('user')->codeRole != '00'){
            return Redirect::back()->with('deleteMessage','You have not Admin access');
        }
        return $next($request);
    }
}
