<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\permission_role;
use App\Models\Role;
use App\Models\User;
use App\Models\user_Permission;
use App\Models\user_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

 
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-role'])->only('index');
        $this->middleware(['permission:create-role'])->only('create');
        $this->middleware(['permission:update-role'])->only('edit');
        $this->middleware(['permission:delete-role'])->only('destroy');

    }//end of constructor
    public function index()
    {

        if (Auth::user()->hasRole('Admin')) {
            $roles = Role::where('ent_id',null)->get();
            return view('dashboard.role.index', compact('roles'));
        } elseif (Auth::user()->hasRole('Enterprises')) {
            $roles = Role::where('ent_id',auth()->user()->ent_id)->get();
            // $roles = user_roles::where('user_id', Auth::user()->id)->with('role')->get();
            return view('dashboard.role.index', compact('roles'));
        } elseif (Auth::user()->hasRole('Vendors')) {
            $roles = Role::where('vendor_id',auth()->user()->vendor_id)->get();
            return view('dashboard.role.index', compact('roles'));
        }
    }
    public function create()
    {
        if (Auth::user()->hasRole('Admin')) {
        $permission = Permission::get();
        }elseif (Auth::user()->hasRole('Enterprises')) {
            $permission = Permission::where('is_admin',0)->get();
        }
        elseif (Auth::user()->hasRole('Vendors')) {
            $permission = Permission::where('is_vendor',1)->get();
        }

        $uiPermission = [];
        foreach($permission as $index => $permission)
        {
            $key = str_replace(['create', 'read', 'update', 'delete'], [], strtolower($permission->name));
            $key = str_replace(['-', '_'], ' ', $key);
            $key = ucwords(trim($key));

            $uiPermission[$key][] = $permission;
        }
        return view('dashboard.role.create')->with('uiPermission',$uiPermission);
    }

    public function store(Request $request)
    {

        $data = $request->except(array('_token'));
        $rule = array(
            'display_name' => 'required|unique:roles,display_name',
        );
        if (app()->getLocale() == "en") {
            $messages = array(

                'display_name.required' => 'Please Enter Displsy Name',
                'display_name.unique' => 'This Name Is Already Exist',
            );
        } elseif (app()->getLocale() == "ar") {
            $messages = array(

                'display_name.required' => 'من فضلك ادخل الاسم',
                'display_name.unique' => 'هذا الاسم بالفعل موجود',
            );
        }
        $validator = Validator::make($data, $rule, $messages);
        if ($validator->fails()) {
            return Redirect::route('role.create', ['locale' => app()->getLocale()])->withErrors($validator)->withInput();
        } else {
            $new_role = new Role();
            
            $new_role->name = $request->name;
            $new_role->display_name = $request->display_name;
            $new_role->description = $request->description;
            if (Auth::user()->hasRole('Enterprises')) {
                $new_role->ent_id = auth()->user()->ent_id;   
            }
            if (Auth::user()->hasRole('Vendors')) {
                $new_role->vendor_id = auth()->user()->vendor_id;   
            }

            $new_role->save();
            // dd($new_role);
            $new_role->attachPermissions($request->permission_ids);


            if (Auth::user()->hasRole('Enterprises|Vendors')) {
                $role = new user_roles();
                $role->role_id =  $new_role->id;
                $role->user_id =  Auth::user()->id;

                $role->save();
            }
            

            return Redirect::route('role.index', ['locale' => app()->getLocale()]);
        }
    }

    public function show($locale, $role_id)
    {
        $role = Role::find($role_id);
        return view('dashboard.role.show', compact('role'));
    }

    public function edit($locale, $role_id)
    {

        

        
       
        // auth()->user()->attachRole('Admin');
        // dd('dd');

        if (Auth::user()->hasRole('Admin')) {
            // $role = Role::find($role_id);
            // $all_permissions = Permission::all();
            $role = Role::find($role_id);
            $all_permissions = Permission::all();

            
        } elseif (Auth::user()->hasRole('Enterprises')) {
            $role = Role::find($role_id);
            $all_permissions = Permission::where('is_admin',0)->get();
             
        } elseif (Auth::user()->hasRole('Vendors')) {
            $role = Role::find($role_id);
            $all_permissions = Permission::where('is_vendor',1)->get();
            
        }

        $all_permissions   = $all_permissions->map(function ($data){
            $data->perType = ucwords(trim(str_replace(['-', '_'], ' ', $data->name)));
            return $data;
        });

        $uiPermission = [];
        foreach($all_permissions as $index => $permission)
        {
            $key = str_replace(['create', 'read', 'update', 'delete'], [], strtolower($permission->name));
            $key = str_replace(['-', '_'], ' ', $key);
            $key = ucwords(trim($key));

            $uiPermission[$key][] = $permission;

        }

        return view('dashboard.role.edit', compact('role', 'all_permissions', 'uiPermission'));

    }
    public function update(Request $request, $locale, $role_id)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'name' => 'required',
            'display_name' => 'required',
        );
        if (app()->getLocale() == "en") {
            $messages = array(
                'name.required' => 'Please Enter Name of Role',
                'display_name.required' => 'Please Enter Name of Role',
            );
        } elseif (app()->getLocale() == "ar") {
            $messages = array(
                'name.required' => 'من فضلك ادخل اسم الدور',
                'display_name.required' => 'من فضلك ادخل اسم الدور',
            );
        }
        $validator = Validator::make($data, $rule, $messages);
        if ($validator->fails()) {
            return Redirect::route('role.edit', ['locale' => app()->getLocale(), 'role_id' => $role_id])->withErrors($validator)->withInput();
        } else {
            $role = Role::find($role_id);
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();
            if ($request->permission_ids != null) {
                //delete role_permission
                $get_permissions_of_role = permission_role::where('role_id', $role->id)->get();
                if ($get_permissions_of_role != null) {
                foreach ($get_permissions_of_role as $one_permission_of_role) {
                    $permission = Permission::find($one_permission_of_role->permission_id);
                    $role->detachPermission($permission);
                }
                }
                 foreach ($request->permission_ids as $one_id) {
                     
                    $permission = Permission::find($one_id);
                
                     if (permission_role::where('permission_id', $permission->id)->where('role_id', $role->id)->count() == 0) {
                        $role->attachPermission($permission);
                    }
                }

                $usersId = user_roles::where('role_id',$role->id)->get();
                foreach($usersId as $users ){

                    
                    $userfirst = User::find($users->user_id);
                 
                    
                    $useper = user_Permission::where('user_id',$users->user_id)->truncate();
                   
                    foreach ($request->permission_ids as $one_permission) {
                        $per = new user_Permission();
                        $per->user_id =$users->user_id;
                        $per->permission_id=$one_permission;
                        $per->user_type = $role->name;
                        $per->save();
                    }
                }
            



            }
            

            return Redirect::route('role.edit', [app()->getLocale(), $role_id]);
        }
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
