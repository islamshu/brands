@extends('layout.default')
@section('content')
<div class="
card card-docs mb-2">

    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
        <h2 class="mb-3">Translate file {{ $language }}</h2>
        <form class="form-horizontal" action="{{ route('languages.key_value_store',app()->getLocale()) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $language }}">
        <table class="datatable table datatable-bordered datatable-head-custom  table-row-bordered gy-5 gs-7"
            id="kt_datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Key')}}</th>
                    <th>{{__('Value')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach (openJSONFile('en') as $key => $value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="key">{{ $key }}</td>
                        <td>
                            <input type="text" class="form-control value" style="width:100%" name="key[{{ $key }}]" @isset(openJSONFile($language)[$key])
                                value="{{ openJSONFile($language)[$key] }}"
                            @endisset>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
 
        </table>
        <div class="panel-footer text-right">
            <button type="button" class="btn btn-warning" onclick="copyTranslation()">{{ __('Copy Translations') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>

    </div>
</div>

@endsection

@section('styles')

<link href="{{asset('/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    function copyTranslation() {
        $('#kt_datatable > tbody  > tr').each(function (index, tr) {
            $(tr).find('.value').val($(tr).find('.key').text());
        });
    }

</script>

@endsection