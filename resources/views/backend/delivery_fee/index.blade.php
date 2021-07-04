@extends('backend.layouts.app')

@section('title', __('Delivery Fee Management'))

@section('breadcrumb-links')
    @include('backend.delivery_fee.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Delivery Fee Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.delivery_fee.create')"
                    :text="__('Add Delivery Fee')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:delivery-fees-table />
        </x-slot>
    </x-backend.card>
@endsection
