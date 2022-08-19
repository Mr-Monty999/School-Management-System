<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.view',['only' => 'index' , 'show']);
        $this->middleware('permission:admin.add',['only' => 'create' , 'store']);
        $this->middleware('permission:admin.edit',['only' => 'edit','update']);
    }

    public function index()
    {
        $roles = Role::withCount('permissions','users')->get();
        return view("roles.index", compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {

        $role = Role::UpdateOrCreate(['name' => $request->role_name]);

        $permissions = explode(',', $request->permissions);

        $role->syncPermissions($permissions);

        return redirect()->route('users.index');
    }

    public function show(Role $role)
    {
       $role->load('permissions');

        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        $role_permissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('permissions', 'role', 'role_permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update(['name' => $request->role_name]);

        $permissions = explode(',', $request->permissions);

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index');
    }

}
