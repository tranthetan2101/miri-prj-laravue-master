@inject('model', '\App\Models\Combo')

@extends('backend.layouts.app')

@section('title', __('Create Combo'))

@section('content')
    <x-forms.post :action="route('admin.combo.store')" :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Combo')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.combo.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="name" id="name" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="sku" class="col-md-2 col-form-label">@lang('SKU')</label>

                        <div class="col-md-10">
                            <input type="text" name="sku" placeholder="{{ __('SKU') }}" value="{{ old('sku') }}" maxlength="100" required  class="form-control" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label">@lang('Slug')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="alias" name="slug" class="form-control" placeholder="{{ __('Slug') }}" value="{{ old('slug') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="category_id" class="col-md-2 col-form-label">@lang('Category')</label>

                        <div class="col-md-10">
                            {{ html()->select('category_id', $categories->pluck('name','id'))->class('form-control') }}
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image') (600x235)</label>
                        <div class="col-md-10">
                            <a href="#" role="button" id="lfm" data-multiple="false" data-input="image" data-preview="holder" class="btn btn-outline-primary">
                                Choose
                            </a>
                            <input id="image" class="form-control" type="hidden" name="image">
                            <div id="holder" style="margin-top:15px;max-height:150px;"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-2 col-form-label">@lang('Price')</label>

                        <div class="col-md-10">
                            <input name="price" id="price" class="form-control" type="text" value="{{ str_replace('.','',old('price')) }}" />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="discount_price" class="col-md-2 col-form-label">@lang('Discount Price')</label>

                        <div class="col-md-10">
                            <input name="discount_price" id="discount_price" class="form-control" type="text" value="{{ str_replace('.','',old('discount_price')) }}" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="stock" class="col-md-2 col-form-label">@lang('Stock')</label>

                        <div class="col-md-10">
                            <input name="stock" type="number" class="form-control" placeholder="{{ __('Quantity') }}" value="{{ old('stock') }}" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>
                        <div class="col-md-10">
                            {{ html()->textarea('description')->attribute('rows', 5)
                                ->class('form-control') }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="products" class="col-md-2 col-form-label">@lang('Product')</label>

                        <div class="col-md-10">
                            {{ html()->select('product_id')
                                ->id('product_id')
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Combo')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    <style>
        #holder img {padding: 10px; height: 7rem !important;}
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $(function () {
        $('#price,#discount_price').inputmask({ groupSeparator: ".", radixPoint: ",", min:0, max: 9999999999, placeholder: "0", digits: 0, alias: "numeric", digitsOptional: false, autoGroup: true });
    });
</script>
    <script>
        function slugify(text)
        {
            return text.toString().toLowerCase()
                // Support Vietnamese.
                .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a') // To 'a'.
                .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e') // To 'e'.
                .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i') // To 'i'.
                .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o') // To 'o'.
                .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u') // To 'u'
                .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y') // To 'y'.
                .replace(/đ/gi, 'd') // To 'd'.

                // https://gist.github.com/mathewbyrne/1280286
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

        var route_prefix = "/admin/laravel-filemanager";
        (function ($) {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
            $('#lfm').filemanager('image', {prefix: route_prefix, nultiple: false});
            $('input[data-slug="name"]').keyup(function(){
                    $('input[data-slug="alias"]').val(slugify($(this).val()));
            });
        })(jQuery);
        $('#product_id').select2({
            allowClear: true,
            minimumInputLength: 1,
            placeholder: 'Search for a gift set',
            ajax: {
                url: "{{ route('admin.product.ajax') }}",
                dataType: 'json',
                delay: 300,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        type: 'gift_set',
                        category_id: $('#category_id').val()
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
    </script>
@endpush
