@inject('model', '\App\Models\Contact')

@extends('backend.layouts.app')

@section('title', __('Update Contact'))

@section('content')
    <x-forms.patch :action="route('admin.contact.update', $contact)"  :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Contact')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.contact.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('address', $contact->name) }}" maxlength="150" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label">@lang('Description')</label>

                        <div class="col-md-10">
                            <textarea name="description" class="form-control">{{ old('description', $contact->description) }}</textarea>
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Building')</label>

                        <div class="col-md-10">
                            <input type="text" name="address_building" class="form-control" placeholder="{{ __('Building') }}" value="{{ old('address_building', $contact->address_building) }}" maxlength="150" />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Address')</label>

                        <div class="col-md-10">
                            <input type="text" name="address" class="form-control" placeholder="{{ __('Address') }}" value="{{ old('address', $contact->address) }}" maxlength="150" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('Email')</label>

                        <div class="col-md-10">
                            <input type="text"  name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email', $contact->email) }}" maxlength="50" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="link" class="col-md-2 col-form-label">@lang('Link')</label>

                        <div class="col-md-10">
                            <input type="text"  name="link" class="form-control" placeholder="{{ __('Link') }}" value="{{ old('link', $contact->link) }}" maxlength="50" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="open_time" class="col-md-2 col-form-label">@lang('Open')</label>

                        <div class="col-md-10">
                            <input type="text" id="open_time" name="open_time" class="form-control" placeholder="{{ __('Open') }}" value="{{ old('close_time', $contact->open_time->format('H:i')) }}" maxlength="5" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="close_time" class="col-md-2 col-form-label">@lang('Close')</label>

                        <div class="col-md-10">
                            <input type="text" id="close_time"  name="close_time" class="form-control" placeholder="{{ __('Close') }}" value="{{ old('close_time', $contact->close_time->format('H:i')) }}" maxlength="5" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="phone_number" class="col-md-2 col-form-label">@lang('Phone')</label>

                        <div class="col-md-10">
                            <input type="text"  name="phone_number" class="form-control" placeholder="{{ __('Phone') }}" value="{{ old('phone_number', $contact->phone_number) }}" maxlength="15" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="hotline" class="col-md-2 col-form-label">@lang('Hot Line')</label>

                        <div class="col-md-10">
                            <input type="text"  name="hotline" class="form-control" placeholder="{{ __('Hot line') }}" value="{{ old('hotline', $contact->hotline) }}" maxlength="15" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">@lang('Image')</label>
                        <div class="form-group" id="avatar_location"><img width="100" src="{{ $contact->picture }}"></div>
                        <div class="form-group" id="avatar_location">
                            <input type="file" name="image" class="form-control">
                        </div><!--form-group-->
                    </div><!--form-group-->

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Contact')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
@push('after-scripts')
    <script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
        $(function () {
            $('#open_time,#close_time').inputmask({ mask: "h:s", placeholder: "hh:mm", separator: "-", alias: "datetime" });
        });
    </script>
@endpush
