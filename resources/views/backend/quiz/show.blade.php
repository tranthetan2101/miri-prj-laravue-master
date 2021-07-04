@inject('model', '\App\Models\Quiz')

@extends('backend.layouts.app')

@section('title', __('View Quiz'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('Xem câu hỏi tư vấn')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.quiz.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name', $quiz->name) }}" maxlength="150" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Email')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email', $quiz->email) }}" maxlength="150" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Phone')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Phone') }}" value="{{ old('phone_number', $quiz->phone_number) }}" maxlength="150" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Loại da')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" value="{{ old('type', $quiz->type) }}" maxlength="150" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Vấn đề da')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" value="{{ old('problem', $quiz->problem) }}" maxlength="150" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label">@lang('Note')</label>

                        <div class="col-md-10">
                            <textarea name="description" class="form-control">{{ old('note', $quiz->note) }}</textarea>
                        </div>
                    </div><!--form-group-->

                </div>
            </x-slot>
        </x-backend.card>
@endsection
