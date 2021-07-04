@extends('backend.layouts.app')

@section('title', __('Order Management'))

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Order Management')
        </x-slot>

        <x-slot name="body">
            <livewire:orders-table />
        </x-slot>
    </x-backend.card>
@endsection
