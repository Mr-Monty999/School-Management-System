<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\School;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControlMiddleware
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



        ////If Users Table Is Empty, Make Defualt Row ///


        if (User::count() < 1)
            User::create([
                "name" => "admin",
                "email" => "admin@admin.com",
                "password" => Hash::make("admin"),
                "permission" => "owner",
            ]);



        return $next($request);
    }
}
