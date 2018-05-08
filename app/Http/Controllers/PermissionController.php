<?php
namespace App\Http\Controllers;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
class PermissionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        return $permissions;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles
        return $roles;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
            'roles' => 'required|array'
            ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        if ($request->roles <> '') { 
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value['id']); 
                $role->permissions()->attach($permission);
            }
        }
        return redirect()->back();
    }
   
    public function edit(Permission $permission)
    {
        return $permission;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // $this->validate($request, [
        //     'name'=>'required',
        // ]);
        // $permission->name=$request->name;
        // $permission->save();
        // return $permission;
        $permission = Permission::findOrFail($id);
        
        //Validate name and permission fields
            // $this->validate($request, [
            //     'name'=>'required|max:10|unique:roles,name,'.$id,
            //     'permissions' =>'required',
            // ]);
            $input = $request->except(['roles']);
            $permission->fill($input)->save();
            if($request->permissions <> ''){
                $role->permissions()->sync($request->role);
            }
            return $permission;
            
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return $permission;
    }
}