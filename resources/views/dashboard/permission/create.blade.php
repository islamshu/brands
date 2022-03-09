@extends('layout.default')

@section('title')
{{__('add_permission')}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>{{__('add_permission')}}</h1>  
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('add_permission')}}</li>
                        </ol>
                    </nav>
                </div>    
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <form method="post" action="{{route('permission.store',['locale'=>app()->getLocale()])}}">
                    {{csrf_field()}}    
                    <div class="card" >
                        <div class="body">
                            <div class="row clearfix">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="basic-url"
                                        @if($errors->has('name'))
                                            style="color: red"
                                        @endif
                                    >
                                        {{__('name')}}
                                    </label> 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-pencil"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="{{__('name')}}" name="name" aria-label="name" aria-describedby="basic-addon1" required="required"
                                        @if($errors->has('name'))
                                            style="border: 1px solid red"
                                        @endif 
                                        >
                                    </div>
                                    @if($errors->has('name'))
                                        <p style="color: red">{{$errors->first('name')}}</p>     
                                    @endif                             
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="basic-url"
                                        @if($errors->has('display_name'))
                                            style="color: red"
                                        @endif
                                    >
                                        {{__('display_name')}}
                                    </label> 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-pencil"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="{{__('display_name')}}" name="display_name" aria-label="display_name" aria-describedby="basic-addon1" required="required"
                                        @if($errors->has('display_name'))
                                            style="border: 1px solid red"
                                        @endif 
                                        >
                                    </div>
                                    @if($errors->has('display_name'))
                                        <p style="color: red">{{$errors->first('display_name')}}</p>     
                                    @endif                             
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="basic-url"
                                        @if($errors->has('description'))
                                            style="color: red"
                                        @endif
                                    >
                                        {{__('description')}}
                                    </label> 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-pencil"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="{{__('description')}}" name="description" aria-label="description" aria-describedby="basic-addon1"
                                        @if($errors->has('description'))
                                            style="border: 1px solid red"
                                        @endif 
                                        >
                                    </div>
                                    @if($errors->has('description'))
                                        <p style="color: red">{{$errors->first('description')}}</p>     
                                    @endif                             
                                </div>
                            </div> 
                        </div>  
                    </div>
                    <div class="input-group mb-3">
                        <input type="submit" name="Save Changes" class="btn btn-success" value="{{__('Save_Changes')}}">
                        <a href="{{route('permission.index',['locale'=>app()->getLocale()])}}" class="btn btn-default">
                             {{__('Cancel')}} 
                         </a>
                    </div>
                </div>    
            </div>
        </div>
    </div>    
@endsection