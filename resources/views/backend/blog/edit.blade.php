@inject('model', '\App\Models\Blog')

@extends('backend.layouts.app')

@section('title', __('Update Blog'))

@section('content')
    <x-forms.patch :action="route('admin.blog.update', $blog)"  :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Blog')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.blog.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="name" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $blog->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label">@lang('Slug')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="alias" name="slug" class="form-control" placeholder="{{ __('Slug') }}" value="{{ old('name') ?? $blog->slug }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label"></label>
                        <div class="form-group">
                        <img  width="300" src="{{ $blog->picture }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image') (380x300)</label>
                        <div class="form-group" id="avatar_location">
                            <input type="file" name="image" class="form-control">
                        </div><!--form-group-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>
                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                ->class('form-control')
                                ->value(old('description') ?? $blog->description )
                                ->attribute('maxlength', 200) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="data" class="col-md-2 col-form-label">@lang('Content')</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="data" name="data">{{ old('data') ?? $blog->data }}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Blog')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
@push('after-scripts')
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
            extraPlugins: 'embed',
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}&api_key=69d388a0e5fcd84a5c0f4f',
            format_tags: 'p;h1;h2;h3;h4;h5;h6',
        };
        (function ($) {
            $('input[data-slug="name"]').keyup(function(){
                $('input[data-slug="alias"]').val(slugify($(this).val()));
            });
            CKEDITOR.replace('data', options);
            CKEDITOR.on( 'dialogDefinition', function( ev ) {
                var dialogName = ev.data.name;
                var dialogDefinition = ev.data.definition;
                var editor = ev.editor;
                if ( dialogName == 'table' ) {
                    var info = dialogDefinition.getContents( 'info' );
                    info.get( 'txtWidth' )[ 'default' ] = '100%';       // Set default width to 100%
                    // info.get( 'txtBorder' )[ 'default' ] = '0';         // Set default border to 0
                }
                if (dialogName == 'image') {
                    dialogDefinition.onOk = function (e) {
                        var imageSrcUrl = e.sender.originalElement.$.src.replace(/^.*\/\/[^\/]+/, '');
                        var alt = $('input#name').val() + ' - ' + (new Date().getTime() / 1000 | 0);
                        var imgHtml = CKEDITOR.dom.element.createFromHtml('<img src="' + app_url + imageSrcUrl + '" alt="'+alt+'" style="width:100%;" />');
                        editor.insertElement(imgHtml);
                    };
                }
            });
        })(jQuery);
    </script>
@endpush
