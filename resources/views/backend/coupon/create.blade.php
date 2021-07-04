@inject('model', '\App\Models\Coupon')

@extends('backend.layouts.app')

@section('title', __('Create Coupon'))

@section('content')
    <x-forms.post :action="route('admin.coupon.store')" :enctype="'multipart/form-data'">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Coupon')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.coupon.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="code" class="col-md-2 col-form-label">@lang('Code')</label>

                        <div class="col-md-10">
                            <input style="text-transform: uppercase" type="text" name="code" class="form-control" value="{{ old('code') }}" maxlength="20" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="price" class="col-md-2 col-form-label">@lang('Discount Cost')</label>

                        <div class="col-md-10">
                            <input type="text" name="price" id="price" class="form-control" value="{{ str_replace('.','',old('price')) }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="period_start" class="col-md-2 col-form-label">@lang('Start')</label>

                        <div class="col-md-10">
                            <input type="text" id="period_start" name="period_start" class="form-control" value="{{ old('period_start') }}" maxlength="16" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="period_end" class="col-md-2 col-form-label">@lang('End')</label>

                        <div class="col-md-10">
                            <input type="text" id="period_end" name="period_end" class="form-control" value="{{ old('period_end') }}" maxlength="16" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="used_num" class="col-md-2 col-form-label">@lang('Quantity')</label>

                        <div class="col-md-10">
                            <input type="number" id="used_num" name="used_num" class="form-control"  value="{{ old('used_num') ?? 0 }}" />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="used_num_unlimited" class="col-md-2 col-form-label">@lang('Unlimited?')</label>

                        <div class="col-md-10">
                            <div class="form-check">
                                <input name="used_num_unlimited" id="used_num_unlimited" class="form-check-input" type="checkbox" value="1" {{ old('used_num_unlimited', false) ? 'checked' : '' }} />
                            </div><!--form-check-->
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Coupon')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
@push('after-scripts')
    <script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
        $(function () {
            $('#price').inputmask({ groupSeparator: ".", radixPoint: ",", min:0, max: 999999, placeholder: "0", digits: 0, alias: "numeric", digitsOptional: false, autoGroup: true });
            $('#period_start,#period_end').inputmask({ mask: "y-m-d h:s", placeholder: "yyyy-mm-dd 00:00", separator: "-", alias: "datetime", max: "2038-01-01 00:00" });
        });
    </script>
@endpush
