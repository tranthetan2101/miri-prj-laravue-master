@inject('model', '\App\Models\Product')

@extends('backend.layouts.app')

@section('title', __('Update Product'))

@section('content')
    <x-forms.patch :action="route('admin.product.update', $product)"  :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Product')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.product.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="name" id="name" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $product->name}}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="sku" class="col-md-2 col-form-label">@lang('SKU')</label>

                        <div class="col-md-10">
                            <input type="text" name="sku" placeholder="{{ __('SKU') }}" value="{{ old('sku') ?? $product->sku}}" maxlength="100" required  class="form-control" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label">@lang('Slug')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="alias" name="slug" class="form-control" placeholder="{{ __('Slug') }}" value="{{ old('slug') ?? $product->slug}}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="category_id" class="col-md-2 col-form-label">@lang('Category')</label>

                        <div class="col-md-10">
                            {{ html()->select('category_id', $categories->pluck('name','id'))->class('form-control')->value(old('category_id') ?? $product->category_id) }}
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="images" class="col-md-2 col-form-label">@lang('Images') <br/> (275x395 cho sản phẩm, 590x465 cho combo)</label>
                        <div class="col-md-10">
                            <a href="#" role="button" id="lfm" data-input="images" data-preview="holder" class="btn btn-outline-primary">
                                Choose
                            </a>
                            <input id="images" class="form-control" type="hidden" name="images" value="{{ implode(',',$product->images->pluck('file_name')->toArray())}}" >
                            <div id="holder" style="margin-top:15px;max-height:150px;">
                                @foreach($product->images->pluck('picture') as $idx => $img)
                                <img onclick="removeImage('images',{{$idx}})" data-idx="{{$idx}}" title="Click to Remove" style="height: 7rem" src="{{$img}}" />
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-2 col-form-label">@lang('Price')</label>

                        <div class="col-md-10">
                            <input name="price" id="price" class="form-control" type="text" value="{{ old('price') ? str_replace('.','',old('price')) : $product->price }}" />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="discount_price" class="col-md-2 col-form-label">@lang('Discount Price')</label>

                        <div class="col-md-10">
                            <input name="discount_price" id="discount_price" class="form-control" type="text" value="{{ old('discount_price') ? str_replace('.','',old('discount_price')) : $product->discount_price }}" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="stock" class="col-md-2 col-form-label">@lang('Stock')</label>

                        <div class="col-md-10">
                            <input name="stock" type="number" class="form-control" placeholder="{{ __('Quantity') }}" value="{{ old('stock') ?? $product->stock }}" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="origin" class="col-md-2 col-form-label">@lang('Origin')</label>

                        <div class="col-md-10">
                            <input maxlength="50" name="origin" id="origin" class="form-control" type="text" value="{{ old('origin') ?? $product->origin}}" />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="capacity" class="col-md-2 col-form-label">@lang('Capacity')</label>

                        <div class="col-md-10">
                            <input maxlength="50" name="capacity" id="capacity" class="form-control" type="text" value="{{ old('capacity') ?? $product->capacity }}" />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>
                        <div class="col-md-10">
                            {{ html()->textarea('description')->attribute('rows', 5)
                                ->class('form-control')->value(old('description') ?? $product->description) }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="description_2" class="col-md-2 col-form-label">@lang('Progress')</label>
                        <div class="col-md-10">
                            {{ html()->textarea('description_2')->attribute('rows', 5)
                                ->class('form-control')->value(old('description_2') ?? $product->description_2) }}
                        </div><!--col-->
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="description_3" class="col-md-2 col-form-label">@lang('FAQ')</label>
                        <div class="col-md-10">
                            {{ html()->textarea('description_3')->attribute('rows', 5)
                                ->class('form-control')->value(old('description_3') ?? $product->description_3) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="gift_set" class="col-md-2 col-form-label">@lang('Gift Set?')</label>

                        <div class="col-md-10">
                            {{ html()->select('gift_set[]')
                                ->multiple()
                                ->options($product->gifts->pluck('name','id'))
                                ->value($product->gifts->pluck('id'))
                                ->id('gift_set')
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="recommend" class="col-md-2 col-form-label">@lang('Related Products')</label>

                        <div class="col-md-10">
                            {{ html()->select('recommend[]')
                                ->multiple()
                                ->options($product->recommends->pluck('name','id'))
                                ->value($product->recommends->pluck('id'))
                                ->id('recommend')
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="bonus" class="col-md-2 col-form-label">@lang('Bonus Products')</label>

                        <div class="col-md-10">
                            {{ html()->select('bonus[]')
                                ->multiple()
                                ->options($product->bonuses->pluck('name','id'))
                                ->value($product->bonuses->pluck('id'))
                                ->id('bonus')
                                ->class('form-control')}}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="favorite_flg" class="col-md-2 col-form-label">@lang('Favorite?')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="favorite_flg" id="favorite_flg" class="form-check-input" type="checkbox" value="1" {{ old('active', $product->favorite_flg) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="tag_best" class="col-md-2 col-form-label">@lang('Best seller?')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="tag_best" id="tag_best" class="form-check-input" type="checkbox" value="1" {{ old('tag_best', $product->tag_best) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="tag_best" class="col-md-2 col-form-label">@lang('Recommend?')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="tag_recommend" id="tag_recommend" class="form-check-input" type="checkbox" value="1" {{ old('tag_recommend', $product->tag_recommend) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="tag_sale" class="col-md-2 col-form-label">@lang('Custom Tag')</label>

                        <div class="col-md-10">
                            <input name="tag_sale" id="tag_sale" class="form-control" type="text" value="{{ old('tag_sale') ?? $product->tag_sale }}" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="active" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="active" id="active" class="form-check-input" type="checkbox" value="1" {{ old('active', $product->active) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Product')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
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
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
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
        var app_url = '{{ config('app.url') }}';
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token=',
            extraPlugins: 'embed,autoembed',
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}&api_key=69d388a0e5fcd84a5c0f4f',
            format_tags: 'p;h1;h2;h3;h4;h5;h6',
            height: 200
        };
        var route_prefix = "/admin/laravel-filemanager";
        (function ($) {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
            $('#lfm').filemanager('image', {prefix: route_prefix});
            $('input[data-slug="name"]').keyup(function(){
                $('input[data-slug="alias"]').val(slugify($(this).val()));
            });
            CKEDITOR.replace('description', options);
            CKEDITOR.replace('description_2', options);
            CKEDITOR.replace('description_3', options);

            CKEDITOR.on( 'dialogDefinition', function( ev ) {
                var dialogName = ev.data.name;
                var dialogDefinition = ev.data.definition;
                var editor = ev.editor;
                if ( dialogName == 'table' ) {
                    var info = dialogDefinition.getContents( 'info' );
                    info.get( 'txtWidth' )[ 'default' ] = '100%';
                }
                if (dialogName == 'image') {
                    dialogDefinition.onOk = function (e) {
                        var imageSrcUrl = e.sender.originalElement.$.src.replace(/^.*\/\/[^\/]+/, '');
                        var alt = $('input#name').val() + ' - ' + (new Date().getTime() / 1000 | 0);
                        var imgHtml = CKEDITOR.dom.element.createFromHtml('<img src="' + app_url + imageSrcUrl + '" alt="'+alt+'" style="max-width:100%;" />');
                        editor.insertElement(imgHtml);
                    };
                }
            });
        })(jQuery);
        $('#gift_set,#recommend,#bonus').select2({
            allowClear: true,
            multiple: true,
            minimumInputLength: 1,
            maximumSelectionLength: 4,
            placeholder: 'Search for a product',
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
    </script>
@endpush
