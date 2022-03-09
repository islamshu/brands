@extends('layout.default')

@section('title')
{{__('permissions')}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>{{__('permissions')}}</h1>  
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
	                    <li class="breadcrumb-item"><a href="#">{{__('Dashboard')}}</a></li>
	                    <li class="breadcrumb-item active"><a href="#">{{__('permissions')}}</a></li>
                    </ol>
                </nav>
            </div>            
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <a href="{{route('permission.create',['locale'=>app()->getLocale()])}}" class="btn btn-success">
                    <i class="fa fa-plus"></i> {{__('Add_Permission')}}
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
                            	@foreach($permissions as $one_permission)
	                                <tr>
	                                    <td>{{$one_permission->name}}</td>
                                        <td>{{$one_permission->display_name}}</td>
	                                    <td>{{$one_permission->description}}</td>
	                        
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