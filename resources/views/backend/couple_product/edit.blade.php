@inject('model', '\App\Models\CoupleProduct')

@extends('backend.layouts.app')

@section('title', __('Update Couple Product'))

@section('content')
    <x-forms.patch :action="route('admin.couple_product.update', $coupleProduct)"  :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Couple Product ')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.couple_product.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="product1_id" class="col-md-2 col-form-label">@lang('Product 1')</label>

                        <div class="col-md-10">
                            {{ html()->select('product1_id')
                                ->options([
                                    $coupleProduct->product1->id => $coupleProduct->product1->name
                                    ])
                                ->value($coupleProduct->product1->id)
                                ->id('product1_id')
                                ->class('form-control')
                                ->required()}}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image 1') (485x515)</label>
                        <div class="form-group"><img width="100" src="{{ $coupleProduct->product1_image }}"></div>
                        <div class="form-group">
                            <input type="file" name="product1_image" accept="image/*" class="form-control">
                        </div><!--form-group-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="product2_id" class="col-md-2 col-form-label">@lang('Product 2')</label>

                        <div class="col-md-10">
                            {{ html()->select('product2_id')
                                ->options([
                                    $coupleProduct->product2->id => $coupleProduct->product2->name
                                    ])
                                ->value($coupleProduct->product2->id)
                                ->id('product2_id')
                                ->class('form-control')
                                ->required()}}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image 2') (485x515)</label>
                        <div class="form-group"><img width="100" src="{{ $coupleProduct->product2_image }}"></div>
                        <div class="form-group">
                            <input type="file" name="product2_image" accept="image/*" class="form-control">
                        </div><!--form-group-->
                    </div><!--form-group-->

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Couple Product ')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
@push('after-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(function () {
            $('#product1_id,#product2_id').select2({
                allowClear: true,
                minimumInputLength: 1,
                maximumSelectionLength: 1,
                placeholder: 'Search for product',
                ajax: {
                    url: "{{ route('admin.product.ajax') }}",
                    dataType: 'json',
                    delay: 300,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
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
