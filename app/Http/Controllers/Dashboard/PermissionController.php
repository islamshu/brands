<?php

namespace App\Http\Controllers\Dashboard;

use Auth;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

 
class PermissionController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            // if (Auth::user()->isAbleTo('read-permission')) {
                $permissions = Permission::all();
                return view('dashboard.permission.index', compact('permissions'));
            // }
        }
    }
    public function create()
    {
        if (Auth::user()->hasRole('Admin')) {
        // if (Auth::user()->isAbleTo('create-permission')) {
            return view('dashboard.permission.create');
        // }/
        }
    }
    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'name' => 'required|unique:permissions,name',
            'display_name' => 'required|unique:permissions,display_name',
        );
        if (app()->getLocale() == "en") {
            $messages = array(
                'name.required' => 'Please Enter Permission Name',
                'name.unique' => 'This Name Is Already Exist',
                'display_name.required' => 'Please Enter Displsy Name',
                'display_name.unique' => 'This Name Is Already Exist',
            );
        } elseif (app()->getLocale() == "ar") {
            $messages = array(
                'name.required' => 'من فضلك ادخل اسم لصلاحيه',
                'name.unique' => 'هذا الاسم بالفعل موجود',
                'display_name.required' => 'من فضلك ادخل الاسم',
                'display_name.unique' => 'هذا الاسم بالفعل موجود',
            );
        }
        $validator = Validator::make($data, $rule, $messages);
        if ($validator->fails()) {
            return Redirect::route('permission.create', ['locale' => app()->getLocale()])->withErrors($validator)->withInput();
        } else {
            $new_permission = new Permission();
            $new_permission->name = $request->name;
            $new_permission->display_name = $request->display_name;
            $new_permission->description = $request->description;
            $new_permission->save();
            return Redirect::route('permission.index', ['locale' => app()->getLocale()]);
        }
    }

    public function show($locale, $permission_id)
    {
        $permission = Permission::find($permission_id);
        return view('dashboard.permission.show', compact('permission'));
    }

    public function edit($locale, $permission_id)
    {
        $permission = Permission::find($permission_id);
        return view('dashboard.permission.edit', compact('permission'));
    }

    public function update(Request $request, $locale, $permission_id)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'display_name' => 'required',
        );
        if (app()->getLocale() == "en") {
            $messages = array(
                'display_name.required' => 'Please Enter Name of Permission',
            );
        } elseif (app()->getLocale() == "ar") {
            $messages = array(
                'display_name.required' => 'من فضلك ادخل اسم الصلحيه',
            );
        }
        $validator = Validator::make($data, $rule, $messages);
        if ($validator->fails()) {
            return Redirect::route('permission.edit', ['locale' => app()->getLocale(), 'permission_id' => $permission_id])->withErrors($validator)->withInput();
        } else {
            $permission = Permission::find($permission_id);
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->save();
            return Redirect::route('permission.edit', ['locale' => app()->getLocale(), 'permission_id' => $permission_id]);
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
