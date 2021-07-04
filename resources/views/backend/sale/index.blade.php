@extends('backend.layouts.app')

@section('title', __('Sale Management'))

@section('breadcrumb-links')
    @include('backend.sale.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Sale Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.sale.create')"
                    :text="__('Create Sale')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:sales-table />
        </x-slot>
    </x-backend.card>
@endsection
