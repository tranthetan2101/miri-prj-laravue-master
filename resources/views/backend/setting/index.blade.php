@extends('backend.layouts.app')

@section('title', __('Sale Management'))

@section('breadcrumb-links')
    @include('backend.setting.includes.breadcrumb-links')
@endsection
@section('content')
    @include('app_settings::_settings')
@endsection
@push('after-scripts')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script>
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
            $('.editor').each(function(e){
                CKEDITOR.replace( this.id, options);
            });
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
    </script>
@endpush
