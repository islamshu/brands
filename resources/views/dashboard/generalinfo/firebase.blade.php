{{-- Extends layout --}}

@extends('layout.default')

@section('title','Enterprise')

{{-- Content --}}

@section('content')

<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Firebase') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form class="form" method="POST" action="{{ route('sms_config.store',app()->getLocale()) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
               
                <div class="form-group col-md-6">
                    <label>{{ __('Firebase') }}:</label>
                    <input type="text" value="{{ get_general('firebase') }}" name="general[firebase]" id="firebase" class="form-control form-control-solid"
                        placeholder="Enter firebase"  />
                </div>
             
             
               
             
            </div>
        </div>



        <div class="card-footer">
            <button type="submit" onclick="performStore()" class="btn btn-primary mr-2">{{ __('Submit') }}</button>


    </form>
</div>
</div>
@endsection


