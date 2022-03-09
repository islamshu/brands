

<form class="form" method="post" action="{{ route('send_client_notofication',[app()->getLocale(),$client->id]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="client_id" value="{{ $client->id }}">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Title') }} :</label>
                <input type="text" name="title" id="title" class="form-control form-control-solid"
                    placeholder="{{ __('Title') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Body') }} :</label>
         
                    <textarea name="body" id="body" required class="form-control form-control-solid" cols="10" rows="5"></textarea>
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