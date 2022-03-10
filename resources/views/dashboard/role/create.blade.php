@extends('layout.default')

@section('title')
    {{ __('Add_Role') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>{{ __('Add_Role') }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home.index', ['locale' => app()->getLocale()]) }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('role.index', ['locale' => app()->getLocale()]) }}">
                                    {{ __('Roles') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Add_Role') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <form method="post" action="{{ route('role.store', ['locale' => app()->getLocale()]) }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="body">
                            @if (Auth::user()->hasRole('Admin'))
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label for="basic-url" @if ($errors->has('name'))
                                            style="color: red"
                            @endif
                            >
                            {{ __('Role') }}
                            </label>
                            <div class="input-group mb-3">
                                 <select class="custom-select type" id="type" name="name" @if ($errors->has('name'))
                                    style="border: 1px solid red"
                                    @endif
                                    >
                                    <option value="Admin" @if (Session::get('name') == 'Admin')
                                        selected="selected"
                                        @endif
                                        @if (!$errors->isEmpty())
                                            @if (old('name') == 'Admin')
                                                selected="selected"
                                            @endif
                                        @endif
                                        @if ($errors->has('name'))
                                            style="border: 1px solid red"
                                        @endif
                                        >
                                        {{ __('Admin') }}
                                    </option>


                                    <option value="Enterprises" @if (Session::get('name') == 'Enterprises')
                                        selected="selected"
                                        @endif
                                        @if (!$errors->isEmpty())
                                            @if (old('name') == 'Enterprises')
                                                selected="selected"
                                            @endif
                                        @endif
                                        @if ($errors->has('name'))
                                            style="border: 1px solid red"
                                        @endif
                                        >
                                        {{ __('Enterprises') }}
                                    </option>
                                    <option value="Vendors" @if (Session::get('name') == 'Vendors')
                                        selected="selected"
                                        @endif
                                        @if (!$errors->isEmpty())
                                            @if (old('name') == 'Vendors')
                                                selected="selected"
                                            @endif
                                        @endif
                                        @if ($errors->has('name'))
                                            style="border: 1px solid red"
                                        @endif
                                        >
                                        {{ __('Vendors') }}
                                    </option>
                                    <option value="Branches" @if (Session::get('name') == 'Branches')
                                        selected="selected"
                                        @endif
                                        @if (!$errors->isEmpty())
                                            @if (old('name') == 'Branches')
                                                selected="selected"
                                            @endif
                                        @endif
                                        @if ($errors->has('name'))
                                            style="border: 1px solid red"
                                        @endif
                                        >
                                        {{ __('Branches') }}
                                    </option>
                                </select> 
                                

                            </div>

                            @if ($errors->has('name'))
                                <p style="color: red">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        @endif



                        @if (Auth::user()->hasRole('Enterprises'))
                            <div class="row clearfix">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="basic-url" @if ($errors->has('name'))
                                        style="color: red"
                        @endif
                        >
                        {{ __('Role') }}
                        </label>
                        <div class="input-group mb-3">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                             {{-- <select class="custom-select type" id="type" name="name" @if ($errors->has('name'))
                                style="border: 1px solid red"
                                @endif
                                >
                                <option value="Enterprises" @if (Session::get('name') == 'Enterprises')
                                    selected="selected"
                                    @endif
                                    @if (!$errors->isEmpty())
                                        @if (old('name') == 'Enterprises')
                                            selected="selected"
                                        @endif
                                    @endif
                                    @if ($errors->has('name'))
                                        style="border: 1px solid red"
                                    @endif
                                    >
                                    {{ __('Admin') }}
                                </option>
                                <option value="Vendors" @if (Session::get('name') == 'Vendors')
                                    selected="selected"
                                    @endif
                                    @if (!$errors->isEmpty())
                                        @if (old('name') == 'Vendors')
                                            selected="selected"
                                        @endif
                                    @endif
                                    @if ($errors->has('name'))
                                        style="border: 1px solid red"
                                    @endif
                                    >
                                    {{ __('Vendors') }}
                                </option>

                            </select> 
                             --}}

                        </div>
                        @if ($errors->has('name'))
                            <p style="color: red">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    @endif
                    @if (Auth::user()->hasRole('Vendors'))
                        <div class="row clearfix">
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="basic-url" @if ($errors->has('name'))
                                    style="color: red"
                    @endif
                    >
                    {{ __('Role') }}
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">

                        
                    </div>
                    @if ($errors->has('name'))
                        <p style="color: red">{{ $errors->first('name') }}</p>
                    @endif
            </div>

            @endif

            <div class="form-group col-lg-6 col-md-6">
                <label for="basic-url" @if ($errors->has('display_name'))
                    style="color: red"
                    @endif
                    >
                    {{ __('display_name') }}
                </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-pencil"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="{{ __('display_name') }}" name="display_name"
                        aria-label="display_name" aria-describedby="basic-addon1" required="required" @if ($errors->has('display_name'))
                    style="border: 1px solid red"
                    @endif
                    >
                </div>
                @if ($errors->has('display_name'))
                    <p style="color: red">{{ $errors->first('display_name') }}</p>
                @endif
            </div>

        </div>

        <div class="row clearfix">
            <div class="form-group col-lg-6 col-md-6">
                <label for="basic-url" @if ($errors->has('description'))
                    style="color: red"
                    @endif
                    >
                    {{ __('description') }}
                </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-pencil"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="{{ __('description') }}" name="description"
                        aria-label="description" aria-describedby="basic-addon1" @if ($errors->has('description'))
                    style="border: 1px solid red"
                    @endif
                    >
                </div>
                @if ($errors->has('description'))
                    <p style="color: red">{{ $errors->first('description') }}</p>
                @endif
            </div>
        </div>

    </div>
    </div>
    <div class="card">
        <div class="header">
            <h2>{{ __('Permissions') }}</h2>
        </div>
        <div class="body">
            <div class="card-columns">
                @foreach ($uiPermission as $key => $permissionGroup)
                    <div class="card  bg-primary mb-3">
                        <div class=" card-header">{{ $key }}</div>
                        <ul class="list-group list-group-flush">
                            @foreach ($permissionGroup as $permission)
                                <li class="list-group-item">
                                    <div class="fancy-checkbox">
                                        <label>
                                            @if (Auth::user()->hasRole('Admin'))
                                                <input type="checkbox" name="permission_ids[]"
                                                    value="{{ $permission->id }}">
                                            @endif
                                            @if (Auth::user()->hasRole('Enterprises|Vendors'))
                                                <input type="checkbox" name="permission_ids[]"
                                                    value="{{ $permission->id }}">
                                            @endif
                                            @if (Auth::user()->hasRole('Admin'))
                                                <span>{{ $permission->display_name }}</span>
                                            @endif
                                            @if (Auth::user()->hasRole('Enterprises|Vendors'))
                                                <span>{{ @$permission->display_name }}</span>
                                            @endif
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- ./card -->
                @endforeach

                @php
                    
                @endphp

            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="submit" name="Save Changes" class="btn btn-success" value="{{ __('Save_Changes') }}">
        <a href="{{ route('role.index', ['locale' => app()->getLocale()]) }}" class="btn btn-default">
            {{ __('Cancel') }}
        </a>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
