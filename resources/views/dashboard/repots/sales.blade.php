@extends('layout.default')

@section('content')
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Slaes Repots') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form method="get" action="{{route('get_sales',['locale'=>app()->getLocale()])}}">
        
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
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    From
                                </label>
                            </div>
                          <input type="date" value="{{ $request->from }}" placeholder="from" class="form-control" name="from">
                        </div>
                        @if($errors->has('country_id'))
                        <p style="color: red">{{$errors->first('form')}}</p>
                        @endif
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                    To
                                </label>
                            </div>
                          <input type="date" value="{{ $request->to }}" class="form-control" name="to">
                        </div>
                        @if($errors->has('to'))
                        <p style="color: red">{{$errors->first('to')}}</p>
                        @endif
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>

                    </div>
                </div>
              
            </div>

        </div>
        
    </form>
</div>
<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            {{ __('Slaes Repots') }}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
<form method="get" >
        
 
  
    <div class="card-body">
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="عدد الفروع التي تم الشراء منها" disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $branches }}" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="مجموعة قيمة المشتريات" disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="عدد العمليات الكلي  " disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="عدد العروض الفعالة المنتهاة  " disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $finish_offer }}" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="{{ $active_offer }}" disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="عدد الجنسيات المستفيدة    " disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="افضل فئة عمرية مستفيدة" disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="افضل فئة عمرية مشترية" disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="الجنسية الاكثر شراء  " disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="افضل عرض" disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>
        <div class="row col-md-12" >

            <div class="form-group col-md-6 ">

               <div class="form-group">
                   <input type="text" class="form-control" value="افضل فرع" disabled name="" id="">
               </div>
            </div>
            <div class="form-group col-md-6">

                <div class="form-group">
                    <input type="text" class="form-control" value="1" readonly name="" id="">
                </div>
             </div>
          
        </div>

    </div>
    
</form>
</div>




@endsection

@section('scripts')

@endsection
