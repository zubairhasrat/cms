<?php
namespace App\Http\Controllers;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
class RoleController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return $roles;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();//Get all permissions
        return $permissions;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name'=>'required|unique:roles|max:10',
        //     'permissions' =>'required',
        //     ]
        // );
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }
        return $role->permissions()->get();
    }
   
     public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $role = Role::findOrFail($id);
    //Validate name and permission fields
        // $this->validate($request, [
        //     'name'=>'required|max:10|unique:roles,name,'.$id,
        //     'permissions' =>'required',
        // ]);
        $input = $request->except(['permissions']);
        $role->fill($input)->save();
        if($request->permissions <> ''){
            $role->permissions()->sync($request->permissions);
        }
        return $role->permissions()->get();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return $role;
    }
    public function getRolePermissions(){
        $roles = Role::with('permission')->get(); 
    }
}