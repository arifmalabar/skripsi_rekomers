<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

abstract class BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public $auth;
    public $role;
    public function __construct($role) {
        $this->auth = auth()->guard("teachers");
        $this->role = $role;
    }
    public function handle(Request $request, Closure $next)
    {
        if($this->auth->check() == null && auth()->guard("teachers")->user()->role != $this->role)
        {
            return redirect("/")->with("errmsg", "anda belum login");
        } 
        return $next($request);
    }
}
