<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\School;
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
        $school = null;
        if (School::count() < 1)
            $school = School::create([]);

        if (Admin::count() < 1)
            Admin::create([
                "admin_name" => "admin",
                "password" => Hash::make("admin"),
                "school_id" => $school->id
            ]);



        return $next($request);
    }
}
