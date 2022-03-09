@extends('layout.default')

@section('title')
    {{$permission->display_name}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>{{__('permissions')}}</h1>  
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home.index',['locale'=>app()->getLocale()])}}">
                                {{__('Dashboard')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('permission.index',['locale'=>app()->getLocale()])}}">
                                {{__('permissions')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                             {{$permission->display_name}}
                        </li>
                    </ol>
                </nav>
            </div>            
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <a href="{{route('permission.index',['locale'=>app()->getLocale()])}}" class="btn btn-default">
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
                        {{$permission->name}}
                    </p>                            
                    <hr>
                    <small class="text-muted">
                        {{__('display_name')}}: 
                    </small>
                    <p>
                        {{$permission->display_name}}
                    </p>                            
                    <hr>
                    <small class="text-muted">
                        {{__('description')}}: 
                    </small>
                    <p>
                        {{$permission->description}}
                    </p>                                      
                </div>
            </div>
            <!--Start Permissions-->
            <div class="card">
                <div class="header">
                    <h2>{{__('Roles')}}</h2>
                </div>
                <div class="body">
                    <p>
                        @foreach($permission->roles as $one_role)
                            <span class="badge badge-success">
                                {{$one_role->display_name}}
                            </span>
                        @endforeach
                    </p>                                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection