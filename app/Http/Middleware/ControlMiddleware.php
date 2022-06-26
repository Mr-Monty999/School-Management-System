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



        $school = School::first();
        if (School::count() < 1)
            $school = School::create([]);

        if (User::count() < 1)
            User::create([
                "name" => "admin",
                "email" => "admin@admin.com",
                "password" => Hash::make("admin"),
                "permission" => "owner",
                "school_id" => $school->id
            ]);



        return $next($request);
    }
}
