@extends('layout.default')

@section('content')
@section('styles')
<style>
    /*the container must be positioned relative:*/
    .autocomplete {
        position: relative;
        display: inline-block;
    }

    input {
        border: 1px solid transparent;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 16px;
    }

    input[type=submit] {
        background-color: DodgerBlue;
        color: #fff;
        cursor: pointer;
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
        background-color: DodgerBlue !important;
        color: #ffffff;
    }

</style>
@endsection
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Create currency
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form method="post" ">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="alert {{session()->get('status')}} alert-dismissible fade show" role="alert">
            <span> {{ session()->get('message') }}<span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
        @endif
        <div class="card-body">
            <div class="row">

                <div class="form-group col-md-6">

                    <div class="form-group">
                        <label for="exampleSelectd">name ar</label>
                        <input type="text" name="name_ar" class="form-control" id="name_ar">
                     
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">name en</label>
                        <input type="text" name="name_en" class="form-control" id="name_en">
                     
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectd">code</label>
                        <input type="text" name="code" class="form-control" id="code">
                     
                    </div>
                </div>
                
            </div>

        </div>
        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
    </form>
</div>




@endsection
@section('scripts')
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('crudjs/crud.js')}}"></script>
<script>
    function performStore() {
        let formData = new FormData();
        formData.append('name_ar', document.getElementById('name_ar').value);
        formData.append('name_en', document.getElementById('name_en').value);
        formData.append('code', document.getElementById('code').value);
     
      
        store("{{ route('currency.store', ['locale'=>app()->getLocale()]) }}", formData)

    }
</script>
@endsection
