@extends('backend.layouts.app')

@section('title', __('Coupon Management'))

@section('breadcrumb-links')
    @include('backend.coupon.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Coupon Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.coupon.create')"
                    :text="__('Create Coupon')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:coupons-table />
        </x-slot>
    </x-backend.card>
@endsection
