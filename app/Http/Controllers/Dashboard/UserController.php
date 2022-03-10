<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Models\permission_role;
use App\Models\Role;
use App\Models\User;
use App\Models\user_Permission;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read-user'])->only('index');
        $this->middleware(['permission:create-user'])->only('create');
        $this->middleware(['permission:update-user'])->only('edit');
        $this->middleware(['permission:delete-user'])->only('destroy');
  
    }//end of constructor
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Auth::user()->hasRole('Admin')){
            $users = User::get();
        }elseif(Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('read-user')){
            $users = User::where('ent_id',Auth::user()->ent_id)->get();
        }elseif(Auth::user()->hasRole('Vendors')){
            $users = User::where('vendor_id',Auth::user()->vendor_id)->get();
        }
        return response()->view('dashboard.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        if(Auth::user()->hasRole('Admin')){
            $user = User::get();
            $enterprises  = Enterprise::get();
            $rols = Role::get();
            return response()->view('dashboard.users.create', compact('user','enterprises','rols'));

        }elseif(Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('create-user')){
            $enterprice = Enterprise::get();
            $venders = Vendor::where('enterprise_id',Auth::user()->vendor_id)->get();
            $rols = Role::where('ent_id',auth()->user()->ent_id)->get();
            return response()->view('dashboard.users.create',compact('venders','rols')); 
        }elseif(Auth::user()->hasRole('Vendors')){
            dd('dd');
            $rols = Role::where('vendor_id',Auth::user()->vendor_id)->get();
            return response()->view('dashboard.users.create',compact('rols')) ;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'username' => 'required|string|min:3',
            'email' => 'required|string|min:3',
            'password' => 'required',
            'role' => 'required',
            'email'=>'required|unique:users,email',
            'address'=>'required', 
        ]);
    
        if (!$validator->fails()) {
            $user = new User();
            if(Auth::user()->hasRole('Admin')){
         
            if($request->model_type=='enterprice'){
                $user->ent_id =$request->enterprise_id;
                $user->vendor_id = $request->vendor_id;
            }elseif($request->model_type == 'brands'){
                $user->vendor_id = $request->vendor_id;
            }
        }elseif(Auth::user()->hasRole('Enterprises')){
            $user->ent_id = auth()->user()->ent_id;
            $user->vendor_id =$request->vendor_id;

        }elseif(Auth::user()->hasRole('Vendors')){
            $user->vendor_id=auth()->user()->vendor_id;
        }
            $user->username = $request->username;
            $user->name = $request->username;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->address = $request->address;
            $user->last_ip= '';
            $user->vendor_id = auth()->user()->vendor_id;
            $user->Save();
            $role = Role::where('name', $request->role)->first();
            
            $user->attachRole($role);
           $permissions= permission_role::where('role_id',$role->id)->get();
            
            foreach ($permissions as $one_permission) {
                $per = new user_Permission();
                $per->user_id = $user->id;
                $per->permission_id = $one_permission->permission_id;
                $per->save();
                // $user->attachPermission($one_permission);
            }
            $role = Role::find(3);

            $user->attachRole($role);
           $permissions= permission_role::where('role_id',$role->id)->get();
            
            foreach ($permissions as $one_permission) {
                $per = new user_Permission();
                $per->user_id = $user->id;
                $per->permission_id = $one_permission->permission_id;
                $per->save();
                // $user->attachPermission($one_permission);
            }
             return response()->json(['icon' => 'success', 'title' => 'user created successfully'], $user ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

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
    public function edit($local,$id)
    {
          
        if(Auth::user()->hasRole('Admin')){
            $user = User::find($id);
            $enterprises  = Enterprise::get();
            $rols = Role::get();
            return response()->view('dashboard.users.edit', compact('user','enterprises','rols'));

        }elseif(Auth::user()->hasRole('Enterprises') || auth()->user()->hasPermission('update-user')){
            $enterprice = Enterprise::get();
            $venders = Vendor::where('enterprise_id',Auth::user()->vendor_id)->get();
            $rols = Role::get();
            $user = User::find($id);

            return response()->view('dashboard.users.edit',compact('venders','rols','user')); 
        }elseif(Auth::user()->hasRole('Vendors')){
            $rols = Role::where('vendor_id',auth()->user()->vendor_id)->get();
            $user = User::find($id);

            return response()->view('dashboard.users.edit',compact('rols')) ;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request,$local, $id)
    {
        $user = User::find($id);
        $validator = Validator($request->all(), [
            'username' => 'required|string|min:3',
            'email' => 'required|string|min:3',
            'role' => 'required',
            'email'=>'required|unique:users,email,'. $user->id,
            'address'=>'required', 
        ]);
    
        if (!$validator->fails()) {
           
            if(Auth::user()->hasRole('Admin')){
         
                $user->ent_id =$request->enterprise_id;
                $user->vendor_id = $request->vendor_id;
        }elseif(Auth::user()->hasRole('Enterprises')){
            $user->ent_id =auth()->user()->ent_id;
            $user->vendor_id = $request->vendor_id;

        }elseif(Auth::user()->hasRole('Vendors')){
            $user->vendor_id =auth()->user()->vendor_id;
        }
            $user->username = $request->username;
            $user->name = $request->username;
            if($request->password != null){
                $user->password = bcrypt($request->password);
            }
            $user->email = $request->email;
            $user->address = $request->address;
            $user->last_ip= '';
            $user->Save();
            if($user->roles->first()->name != $request->role){
                $role = Role::where('name', $request->role)->first();
                $user->attachRole($role);
                foreach ($role->permissions as $one_permission) {
                    $user->attachPermission($one_permission);
                }
            }
          
             return response()->json(['icon' => 'success', 'title' => 'user edit successfully'], $user ? 200 : 400);
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale,$id)
    {
        $user = User::find($id);
        $user->delete();
        if ($user->delete()) {
            return response()->json(['icon' => 'success', 'title' => 'user deleted successfully'], 200);
        } else {
            return response()->json(['icon' => 'error', 'title' => 'error when delete'], 400);
        }
    }
}
