
<form class="form" method="post" action="{{ route('importOffer',[app()->getLocale(),$vendor->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Upload file') }} :</label>
                <input type="file" name="file" id="file" class="form-control form-control-solid"
                    placeholder="{{ __('Upload file') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input type="submit"  class="form-control btn btn-primary" value="{{ __('Submit') }}"
                  />
            </div>
        </div>
    </div>
</form>