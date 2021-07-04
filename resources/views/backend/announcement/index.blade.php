@extends('backend.layouts.app')

@section('title', __('Announcement Management'))

@section('breadcrumb-links')
    @include('backend.announcement.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Announcement Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.announcement.create')"
                    :text="__('Create Announcement')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:announcements-table />
        </x-slot>
    </x-backend.card>
@endsection
