@inject('model', '\App\Models\Category')

@extends('backend.layouts.app')

@section('title', __('Update Category'))

@section('content')
    <x-forms.patch :action="route('admin.category.update', $category)"  :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Category')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.category.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="name" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $category->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label">@lang('Slug')</label>

                        <div class="col-md-10">
                            <input type="text" data-slug="alias" name="slug" class="form-control" placeholder="{{ __('Slug') }}" value="{{ old('name') ?? $category->slug }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image')</label>
                        <div class="form-group" id="avatar_location"><img width="100" src="{{ $category->picture }}"></div>
                        <div class="form-group" id="avatar_location">
                            <input type="file" name="image" class="form-control">
                        </div><!--form-group-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="visible" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="visible" id="visible" class="form-check-input" type="checkbox" value="1" {{ old('visible', $category->visible) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Category')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
@push('after-scripts')
    <script>
        function slugify(text)
        {
            return text.toString().toLowerCase()
                // Support Vietnamese.
                .replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a') // To 'a'.
                .replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e') // To 'e'.
                .replace(/i|??|??|???|??|???/gi, 'i') // To 'i'.
                .replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o') // To 'o'.
                .replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u') // To 'u'
                .replace(/??|???|???|???|???/gi, 'y') // To 'y'.
                .replace(/??/gi, 'd') // To 'd'.

                // https://gist.github.com/mathewbyrne/1280286
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

        (function ($) {
            $('input[data-slug="name"]').keyup(function(){
                $('input[data-slug="alias"]').val(slugify($(this).val()));
            });
        })(jQuery);
    </script>
@endpush
