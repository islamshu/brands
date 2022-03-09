@extends('layout.default')

@section('title')
{{__('Edit_Role')}}
@endsection

@section('content')

<div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>{{__('Edit_Role')}}</h1>
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('Edit_Role')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <form method="post" action="{{route('role.update',[app()->getLocale(),$role->id])}}">
                    {{csrf_field()}} @method('put')
                    <div class="card" >
                        <div class="header">
                            <h2>{{__('Edit_Role')}}</h2>
                        </div>
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
                                        <input type="text" class="form-control" placeholder="{{__('name')}}" name="name" value="{{$role->name}}" aria-label="name" aria-describedby="basic-addon1" required="required"
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
                                        <input type="text" class="form-control" placeholder="{{__('display_name')}}" name="display_name" value="{{$role->display_name}}" aria-label="display_name" aria-describedby="basic-addon1" required="required"
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
                                        <input type="text" class="form-control" placeholder="{{__('description')}}" name="description" value="{{$role->description}}" aria-label="description" aria-describedby="basic-addon1"
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
                    <div class="card" >
                        <div class="header">
                            <h2>{{__('Permissions')}}</h2>
                        </div>
                        <div class="body">
                            <div class="card-columns">
                              @foreach($uiPermission as $key => $permissionGroup)
                                    <div class="card  bg-primary mb-3">
                                        <div class=" card-header">{{ $key }}</div>
                                        <ul class="list-group list-group-flush">
                                        @foreach( $permissionGroup as $permission )
                                            <li class="list-group-item">
                                                <div class="fancy-checkbox">
                                                   <label>
                                                        @if(Auth::user()->hasRole('Admin'))
                                                        <input type="checkbox" name="permission_ids[]" value="{{$permission->id}}"
                                                        @foreach($role->permissions as $role_permession)
                                                        @if($role_permession->id == $permission->id)
                                                            checked="checked"
                                                        @endif
                                                        @endforeach
                                                        >
                                                        @endif
                                                           @if(Auth::user()->hasRole('Enterprises|Vendors'))
                                                        <input type="checkbox" name="permission_ids[]" value="{{$permission->id}}"
                                                        @foreach($role->permissions as $role_permession)
                                                        @if($role_permession->id == $permission->id)
                                                            checked="checked"
                                                        @endif
                                                        @endforeach
                                                        >
                                                        @endif
                                                        @if(Auth::user()->hasRole('Admin'))
                                                        <span>{{$permission->display_name}}</span>
                                                        @endif
                                                         @if(Auth::user()->hasRole('Enterprises|Vendors'))
                                                        <span>{{$permission->display_name}}</span>
                                                       @endif
                                                     </label>
                                                </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div><!-- ./card -->
                                @endforeach

                                @php
                                /*
                                @foreach($all_permissions as $one_permission)
                                
                                    <div class="col-lg-3 col-md-12">
                                        <div class="fancy-checkbox">
                                            <label>
                                                
                                                <input type="checkbox" name="permission_ids[]" value="{{$one_permission->id}}"
                                                @foreach($role->permissions as $role_permession)
                                                   @if($role_permession->id == $one_permission->id)
                                                       checked="checked"
                                                   @endif
                                                @endforeach
                                                >
                                                @if(Auth::user()->hasRole('Admin'))
                                                <span>{{$one_permission->display_name}}</span>
                                                @endif
                                                 @if(Auth::user()->hasRole('Enterprises|Vendors'))
                                                <span>{{$one_permission->Permission->display_name}}</span>
                                                 @endif
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                */
                                @endphp

                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="submit" name="Save Changes" class="btn btn-success" value="{{__('Save_Changes')}}">
                        <a href="{{route('role.index',['locale'=>app()->getLocale()])}}" class="btn btn-default">
                             {{__('Cancel')}}
                         </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
<script src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script>
$('.grid').masonry({
  itemSelector: '.grid-item',
  columnWidth: '.grid-sizer',
  percentPosition: true
});
</script>
@endsection
