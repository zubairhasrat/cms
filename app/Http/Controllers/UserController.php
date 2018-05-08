<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return $users;
    }
    public function create()
    {
        $roles = Role::get();        
        return $roles;
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required'
        ]);
        $user = User::create($request->except('roles'));
        
        if($request->roles <> ''){
            $user->roles()->attach($request->roles);
        }
        return response()->json($user);     
        
    }
    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::get(); 
        return response()->json([$user,$roles]); 
    }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);   
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
        ]);
        $input = $request->except('roles');
        $user->fill($input)->save();
        if ($request->roles <> '') {
            $user->roles()->sync($request->roles);        
        }        
        else {
            $user->roles()->detach(); 
        }
        return response()->json($user);
    }
    public function destroy($id) {
        $user = User::findOrFail($id); 
        $user->delete();
        return $user;
    }
    public function show($id){
        $user = User::findOrFail($id);
        return $user;
    }
    public function getAuthUser(){
        $user = auth()->user();
        $role = auth()->user()->roles->pluck('id');
        $allRole = Role::with('permissions')->get();
       foreach($allRole as $r){
           foreach($role as $arole){
            if($r->id == $arole){
                $per = $r->permissions;
               }
           }
       }
        $user->permissions = $per;
        $user->roles = auth()->user()->roles->pluck('name');
        return $user;
    }
}