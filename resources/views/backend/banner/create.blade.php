@inject('model', '\App\Models\Banner')

@extends('backend.layouts.app')

@section('title', __('Create Banner'))

@section('content')
    <x-forms.post :action="route('admin.banner.store')" :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Banner')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.banner.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="link" class="col-md-2 col-form-label">@lang('Url')</label>

                        <div class="col-md-10">
                            <input type="text"  name="url" class="form-control" placeholder="{{ __('Url') }}" value="{{ old('url') }}" maxlength="200" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image') (1300x640)</label>
                        <div class="form-group" id="avatar_location">
                            <input type="file" name="name" class="form-control" required>
                        </div><!--form-group-->
                    </div><!--form-group-->


                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Banner')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
