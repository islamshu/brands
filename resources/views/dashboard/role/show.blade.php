@extends('dashboard.layouts.master')

@section('title')
    {{$role->display_name}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>{{__('Roles')}}</h1>  
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home.index',['locale'=>app()->getLocale()])}}">
                                {{__('Dashboard')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('role.index',['locale'=>app()->getLocale()])}}">
                                {{__('Roles')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                             {{$role->display_name}}
                        </li>
                    </ol>
                </nav>
            </div>            
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <a href="{{route('role.index',['locale'=>app()->getLocale()])}}" class="btn btn-default">
                    <i class="fa fa-reply"></i> {{__('Back')}}
                </a>
            </div>
        </div>
    </div>
    
    <div class="row clearfix">
        <div class="col-lg-12">
            <!--Start Role Data-->
            <div class="card">
                <div class="body">
                    <small class="text-muted">
                        {{__('name')}}: 
                    </small>
                    <p>
                        {{$role->name}}
                    </p>                            
                    <hr>
                    <small class="text-muted">
                        {{__('display_name')}}: 
                    </small>
                    <p>
                        {{$role->display_name}}
                    </p>                            
                    <hr>
                    <small class="text-muted">
                        {{__('description')}}: 
                    </small>
                    <p>
                        {{$role->description}}
                    </p>                                      
                </div>
            </div>
            <!--Start Permissions-->
            <div class="card">
                <div class="header">
                    <h2>{{__('permissions')}}</h2>
                </div>
                <div class="body">
                    <p>
                        @foreach($role->permissions as $one_permission)
                            <span class="badge badge-success">
                                {{$one_permission->display_name}}
                            </span>
                        @endforeach
                    </p>                                      
                </div>
            </div>
            <!--Start Users-->
            <div class="card">
                <div class="header">
                    <h2>{{__('Users')}}</h2>
                </div>
                <div class="body">  
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                            <thead>
                                <tr>
                                    <th>{{__('Username')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Activated')}}</th>
                                    <th>{{__('Is_Branch')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{__('Username')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Activated')}}</th>
                                    <th>{{__('Is_Branch')}}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($role->users as $users)
                                    <tr>
                                        <td>
                                            {{$users->username}}
                                        </td>
                                        <td>
                                            {{$users->email}}
                                        </td>
                                        <td>
                                            <span class="btn btn-default">
                                                @if($users->activated == "1")
                                                    Activated
                                                @else
                                                    Deactivated
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{$users->is_branch}}</td>
                                        <td>
                                            <a href="{{route('user.show',['locale'=>app()->getLocale(),'user_id'=>$users->id])}}" class="btn btn-info">
                                                <i class="fa fa-info"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection