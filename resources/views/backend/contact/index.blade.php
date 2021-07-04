@extends('backend.layouts.app')

@section('title', __('Contact Management'))

@section('breadcrumb-links')
    @include('backend.contact.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Contact Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.contact.create')"
                    :text="__('Create Contact')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:contacts-table />
        </x-slot>
    </x-backend.card>
@endsection
