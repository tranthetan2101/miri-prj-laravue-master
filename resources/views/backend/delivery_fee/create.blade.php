@inject('model', '\App\Models\DeliveryFee')

@extends('backend.layouts.app')

@section('title', __('Create Delivery Fee'))

@section('content')
    <x-forms.post :action="route('admin.delivery_fee.store')" :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Delivery Fee')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.delivery_fee.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="city_id" class="col-md-2 col-form-label">@lang('City')</label>

                        <div class="col-md-10">
                            {{ html()->select('city_id')
                                ->attribute('data-type', 'city')
                                ->id('city_id')
                                ->required()
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="district_id" class="col-md-2 col-form-label">@lang('District')</label>

                        <div class="col-md-10">
                            {{ html()->select('district_id')
                                ->attribute('data-type', 'district')
                                ->attribute('data-parent', 'city_id')
                                ->id('district_id')
                                ->required()
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="ward_id" class="col-md-2 col-form-label">@lang('Ward')</label>

                        <div class="col-md-10">
                            {{ html()->select('ward_id')
                                ->attribute('data-type', 'ward')
                                ->attribute('data-parent', 'district_id')
                                ->id('ward_id')
                                ->required()
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="fee" class="col-md-2 col-form-label">@lang('Fee')</label>

                        <div class="col-md-10">
                            <input name="fee" id="fee" class="form-control" type="text" value="{{ str_replace('.','',old('fee')) }}" />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create DeliveryFee')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
        $(function () {
            $('#fee').inputmask({ groupSeparator: ".", radixPoint: ",", min:0, max: 999999, placeholder: "0", digits: 0, alias: "numeric", digitsOptional: false, autoGroup: true });
            $('#city_id,#district_id,#ward_id').select2({
                allowClear: true,
                minimumInputLength: 1,
                maximumSelectionLength: 1,
                placeholder: 'Search',
                ajax: {
                    url: "{{ route('admin.delivery_fee.ajax') }}",
                    dataType: 'json',
                    delay: 300,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                            type: $(this).data('type'),
                            parent: $('#'+$(this).data('parent')).val()
                        };
                    },
                    processResults: function (response, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        let results = $.map(response.data, function (obj) {
                            obj.text = obj.text || obj.name; // replace pk with your identifier
                            return obj;
                        });
                        return {
                            results: results,
                            pagination: {
                                more: (params.page * response.per_page) < response.total
                            }
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endpush
