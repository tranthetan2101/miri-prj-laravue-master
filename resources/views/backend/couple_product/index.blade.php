@extends('backend.layouts.app')

@section('title', __('Couple Product Management'))

@section('breadcrumb-links')
    @include('backend.couple_product.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Couple Product Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.couple_product.create')"
                    :text="__('Add Couple Product')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:couple-products-table />
        </x-slot>
    </x-backend.card>
@endsection
