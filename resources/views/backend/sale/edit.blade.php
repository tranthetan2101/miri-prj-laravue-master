@inject('model', '\App\Models\Sale')

@extends('backend.layouts.app')

@section('title', __('Update Sale'))

@section('content')
    <x-forms.patch :action="route('admin.sale.update', $sale)"  :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Sale')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.sale.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" value="{{ old('name', $sale->name) }}" maxlength="100" required />
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="period_start" class="col-md-2 col-form-label">@lang('Start')</label>

                            <div class="col-md-10">
                                <input type="text" id="period_start" name="period_start" class="form-control" value="{{ old('period_start', timezone()->convertToLocal($sale->period_start, "Y-m-d H:i")) }}" maxlength="16" required />
                            </div>
                        </div><!--form-group-->
                        <div class="form-group row">
                            <label for="period_end" class="col-md-2 col-form-label">@lang('End')</label>

                            <div class="col-md-10">
                                <input type="text" id="period_end" name="period_end" class="form-control" value="{{ old('period_end', timezone()->convertToLocal($sale->period_end, "Y-m-d H:i")) }}" maxlength="16" required />
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="sale_amount" class="col-md-2 col-form-label">@lang('Discount Price')</label>

                            <div class="col-md-10 row no-margin-left">
                                <input type="number" id="sale_amount" name="sale_amount" class="form-control w-25"  value="{{ old('sale_amount', $sale->sale_amount) ?? 0 }}" />
                                <div class="type-sale_amount ml-2 pt-2">
                                    <input type="radio" name="type" id="percent" value="0" {{ !$sale->type ? 'checked' : '' }}>
                                    <label for="percent">%</label>
                                    <input type="radio" name="type" id="money" value="1" {{ $sale->type ? 'checked' : '' }}>
                                    <label for="money">VND</label>
                                </div>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="sale_items" class="col-md-2 col-form-label">@lang('Sale Items')</label>

                            <div class="col-md-10">
                                {{ html()->select('sale_items[]')
                                    ->multiple()
                                    ->options($sale->products->pluck('name','id'))
                                    ->value($sale->products->pluck('id'))
                                    ->id('sale_items')
                                    ->class('form-control')}}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Sale')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
@push('after-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
        $(function () {
            $('#period_start,#period_end').inputmask({ mask: "y-m-d h:s", placeholder: "yyyy-mm-dd 00:00", separator: "-", alias: "datetime" });
            $('#sale_items').select2({
                allowClear: true,
                multiple: true,
                minimumInputLength: 1,
                maximumSelectionLength: 50,
                placeholder: 'Search for product',
                ajax: {
                    url: "{{ route('admin.product.ajax') }}",
                    dataType: 'json',
                    delay: 300,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (response, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        let results = $.map(response.data, function (obj) {
                            obj.text = obj.text || obj.name + ' (' + obj.sku + ')'; // replace pk with your identifier
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
