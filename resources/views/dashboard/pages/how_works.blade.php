@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            How Its Work 
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
   

    <form class="form" method="post" method="{{ route('How-it-work.store',app()->getLocale()) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
              
                <div class="form-group col-md-6">
                    <label> {{ __('title ar') }} :</label>
                    <input type="text" value="{{ @$work->title_ar }}" name="title_ar" id="name_ar" class="form-control form-control-solid"
                        placeholder="Enter Title" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('title en') }} :</label>
                    <input type="text" value="{{ @$work->title_en }}" name="title_en" id="name_en" class="form-control form-control-solid"
                        placeholder="Enter Title" required />
                </div>
                <div class="form-group col-md-6">
                    <label>{{ __('Video') }} :</label>
                    <input type="text" value="{{ @$work->link }}" name="link" id="link" class="form-control form-control-solid"
                    placeholder="Enter Title" required />
                </div>
               

                   @if (auth()->user()->isAbleTo(['create-page']))

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
            </div>
            @endif
    </form>
</div>
</div>
@endsection
