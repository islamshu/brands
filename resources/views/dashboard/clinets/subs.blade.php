

<form class="form" method="post" action="{{ route('add_sub_for_user',[app()->getLocale(),$client->id]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="client_id" value="{{ $client->id }}">
    
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Package') }} :</label>
                <select name="sub_id" class="form-control form-control-solid" id="">
                    <option value="">{{ __('select') }}</option>
                    @foreach ($subs as $sub)
                    <option value="{{ $sub->id }}">@if(app()->getLocale() == 'ar') {{ $sub->name_ar }} @else {{ $sub->name_en }} @endif </option>  
                    @endforeach
                </select>
                
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('start date') }} :</label>
                <input type="date" name="start_date" id="title" class="form-control form-control-solid"
                    placeholder="{{ __('start date') }}"  />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('expire date') }} :</label>
         
                <input type="date" name="end_date" id="title" class="form-control form-control-solid"
                placeholder="{{ __('end date') }}"  />            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input type="submit"  class="form-control btn btn-primary" value="{{ __('Submit') }}"
                  />
            </div>
        </div>
    </div>
</form>