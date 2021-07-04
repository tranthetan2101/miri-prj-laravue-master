@extends('backend.layouts.app')

@section('title', __('Banner Management'))

@section('breadcrumb-links')
    @include('backend.banner.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Banner Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.banner.create')"
                    :text="__('Create Banner')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:banners-table />
        </x-slot>
    </x-backend.card>
@endsection
