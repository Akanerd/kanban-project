<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Role Lists';
        $roles = Role::all();
        return view('roles.index', ['pageTitle' => $pageTitle, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Add Role';
        $permissions = Permission::all();
        return view('roles.create', ['pageTitle' => $pageTitle, 'permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required'],
            'permissionIds' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name,
            ]);

            $role->permissions()->sync($request->permissionIds);

            DB::commit();

            return redirect()->route('roles.index');
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageTitle = 'Update Role';
        $roles = Role::find($id);
        $permissions = Permission::all();
        return view('roles.edit', ['pageTitle' => $pageTitle, 'role' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'          => ['required'],
            'permissionIds' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->update([
                'name' => $request->name,
            ]);

            $role->permissions()->sync($request->permissionIds);

            DB::commit();

            return redirect()->route('roles.index');
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function delete(string $id)
    {
        $pageTitle = 'Delete Role';
        $role = Role::findOrFail($id);
        return view('roles.delete',['pageTitle'=>$pageTitle, 'role'=>$role]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findorFail($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
