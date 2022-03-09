@extends('layout.default')

@section('title')
{{__('Roles')}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>{{__('Users_Roles')}}</h1>  
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
	                    <li class="breadcrumb-item"><a href="#">{{__('Dashboard')}}</a></li>
	                    <li class="breadcrumb-item active"><a href="#">{{__('Users_Roles')}}</a></li>
                    </ol>
                </nav>
            </div>            
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <a href="{{route('role.create',['locale'=>app()->getLocale()])}}" class="btn btn-success">
                    <i class="fa fa-plus"></i> {{__('Add_Role')}}
                </a>
            </div>
        </div>
    </div>
    
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                            <thead>
                                <tr>
                                    <th>{{__('name')}}</th>
                                    <th>{{__('display_name')}}</th>
                                    <th>{{__('description')}}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{__('name')}}</th>
                                    <th>{{__('display_name')}}</th>
                                    <th>{{__('description')}}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($roles as $one_role)
                                @if(Auth::user()->hasRole('Admin'))
	                                <tr>
	                                    <td>{{$one_role->name}}</td>
                                        <td>{{$one_role->display_name}}</td>
	                                    <td>{{$one_role->description}}</td>
	                                    <td>
                                          
                                            <a href="{{route('role.edit',[app()->getLocale(),$one_role->id])}}" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                     @if(Auth::user()->hasRole('Enterprises|Vendors'))
	                                <tr>
	                                    <td>{{$one_role->name}}</td>
                                        <td>{{$one_role->display_name}}</td>
	                                    <td>{{$one_role->description}}</td>
	                                    <td>
                                       
                                            <a href="{{route('role.edit',[app()->getLocale(),$one_role->id])}}" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
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