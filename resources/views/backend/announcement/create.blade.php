@inject('model', '\App\Models\Announcement')

@extends('backend.layouts.app')

@section('title', __('Create Announcement'))

@section('content')
    <x-forms.post :action="route('admin.announcement.store')" :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Announcement')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.announcement.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Message')</label>

                        <div class="col-md-10">
                            {{ html()->textarea('message')
                                ->class('form-control')
                                ->attribute('maxlength', 255) }}
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="starts_at" class="col-md-2 col-form-label">@lang('Start')</label>

                        <div class="col-md-10">
                            <input type="text" id="starts_at" name="starts_at" class="form-control" value="{{ old('starts_at') }}" maxlength="16" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="ends_at" class="col-md-2 col-form-label">@lang('End')</label>

                        <div class="col-md-10">
                            <input type="text" id="ends_at" name="ends_at" class="form-control" value="{{ old('ends_at') }}" maxlength="16" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="enabled" class="col-md-2 col-form-label">@lang('Active')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="enabled" id="enabled" class="form-check-input" type="checkbox" value="1" {{ old('enabled', true) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Announcement')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    <script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
        $(function () {
            $('#starts_at,#ends_at').inputmask({ mask: "y-m-d h:s", placeholder: "yyyy-mm-dd 00:00", separator: "-", alias: "datetime" });

        });
    </script>
@endpush
