<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Client\RoleRequest;
use Spatie\Permission\Models\Permission;
use App\Models\RoleHasPermissions;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::get();
        $permissions = Permission::get();
        return view('admin.roles.list',compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::get();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        
        if($request->status == "on"){
            $status = 1;
        }else{
            $status =0;
        }
        $roles = Role::create([
            'name' => $request->name,
            'guard_name' => "web",
            'status'=>$status,
          ]);
          if($request->permission != null)
          {
            foreach($request->permission as $perm)
            {
                $permission = permission::find($perm);
                $roles->givePermissionTo($permission);
            }
          }
          return back()->with('status','Role has been created with its permission');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        $rolehaspermission = RoleHasPermissions::where('role_id',$id)->get();
        return view('admin.roles.edit',compact('role','permissions','rolehaspermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        if($request->status == "on"){
            $status = 1;
        }else{
            $status =0;
        }
        $roles = Role::find($id);
        $roles->name = $request->name;
        $roles->status = $status;
        $roles->update();
        $roles->syncPermissions($request->permission);
        return redirect()->route('admin-roles.index')->with('status','Role has been updated with its permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
