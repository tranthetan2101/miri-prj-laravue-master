@inject('model', '\App\Models\Element')

@extends('backend.layouts.app')

@section('title', __('Cập nhật thành phần'))

@section('content')
    <x-forms.patch :action="route('admin.element.update', $element)" >
        <x-backend.card>
            <x-slot name="header">
                @lang('Cập nhật thành phần')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.element.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="name" id="name" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $element->name}}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image') (275x275)</label>
                        <div class="col-md-10">
                            <a href="#" role="button" id="lfm" data-multiple="false" data-input="image" data-preview="holder" class="btn btn-outline-primary">
                                Choose
                            </a>
                            <input id="image" class="form-control" type="hidden" name="image" value="{{ $element->image }}" >
                            <div id="holder" style="margin-top:15px;max-height:150px;">
                                <img onclick="removeImage('image',0)" data-idx="0" title="Click to Remove" style="height: 7rem" src="{{$element->picture}}" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>
                        <div class="col-md-10">
                            {{ html()->textarea('description')->attribute('rows', 5)
                                ->class('form-control')->value(old('description') ?? $element->description) }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Cập nhật thành phần')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
@push('after-scripts')
    <style>
        #holder img {padding: 10px; height: 7rem !important;}
    </style>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        var route_prefix = "/admin/laravel-filemanager";
        (function ($) {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
            $('#lfm').filemanager('image', {prefix: route_prefix, multiple: false});
            $('input[data-slug="name"]').keyup(function(){
                $('input[data-slug="alias"]').val(slugify($(this).val()));
            });

        })(jQuery);
    </script>
@endpush
