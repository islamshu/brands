<form class="form" method="post" action="{{ route('store_city_noto',[app()->getLocale(),$city->id]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="city_id" value="{{ $city->id }}">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Title ar') }} :</label>
                <input type="text" name="title_ar" id="title" class="form-control form-control-solid"
                    placeholder="{{ __('Title') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Title en') }} :</label>
                <input type="text" name="title_en" id="title" class="form-control form-control-solid"
                    placeholder="{{ __('Title') }}" required />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Body ar') }} :</label>
         
                    <textarea name="body_ar" id="body" required class="form-control form-control-solid" cols="10" rows="5"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label> {{ __('Body en') }} :</label>
         
                    <textarea name="body_en" id="body" required class="form-control form-control-solid" cols="10" rows="5"></textarea>
            </div>
        </div>
        <div class="form-group col-md-12 vendor">
            <label>{{ __('Choose Vendor') }}:</label>
            <select name="type" id="vendor_id" class="form-control">
                <option value="" selected disabled>{{ __('Choose') }}</option>
                @foreach ($vendors as $item)
                <option value="{{ $item->id }}" >{{ $item->name_en }}</option>

                @endforeach
               
            </select>

        </div>
        <div class="form-group col-md-12 offer" >
            <label>{{ __('Choose Offer') }}:</label>
            <select name="type" id="offer_id" class="form-control">
                <option value="" selected disabled>{{ __('Offer') }}</option>
             
               
            </select>

        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <input type="submit"  class="form-control btn btn-primary" value="{{ __('Submit') }}"
                  />
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {

        $('#vendor_id').on('change', function() {
            // console.log("hmm its change");
            var cat_id = $(this).val();
            // console.log(cat_id);
            var div = $(this).parent();

            var op = " ";

            $.ajax({
                type: 'get',
                url: "{{ route('get_offer_ajax', ['locale' => app()->getLocale()]) }}",
                data: {
                    'venodr_id': cat_id
                },
                success: function(data) {
                    $('#offer_id').html(new Option('choose', '', 'disabled', 'selected'));
                    for (var i = 0; i < data.length; i++) {

                        $('#offer_id').append(new Option(data[i].name_en,
                            data[i].id));

                    }
                },
                error: function() {

                }
            });

        });
    });
    $('#type').on('change', function() {

        var type = $('#type').val();

        if (type == 'brand') {
            $('.vendor').css("display", "block")
            $('.offer').css("display", "none")

        } else if (type == 'offer') {
            $('.offer').css("display", "block")
            $('.vendor').css("display", "none")
        } else {
            $('.offer').css("display", "none")
            $('.vendor').css("display", "none")
        }


    });
</script>