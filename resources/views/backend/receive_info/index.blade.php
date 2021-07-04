@extends('backend.layouts.app')

@section('title', __('Quản lý danh sách email subscribers'))

@section('breadcrumb-links')
    @include('backend.receive_info.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Quản lý email subscribers')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-arrow-circle-bottom"
                    class="card-header-action"
                    :href="route('admin.receive_info.export')"
                    :text="__('Export')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:receive-infos-table />
        </x-slot>
    </x-backend.card>
@endsection
