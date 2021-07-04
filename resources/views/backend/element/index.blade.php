@extends('backend.layouts.app')

@section('title', __('Thành phần'))

@section('breadcrumb-links')
    @include('backend.element.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Thành phần')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.element.create')"
                    :text="__('Tạo thành phần')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:elements-table />
        </x-slot>
    </x-backend.card>
@endsection
