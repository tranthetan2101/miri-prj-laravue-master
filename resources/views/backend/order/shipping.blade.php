@extends('backend.layouts.app')

@section('title', __('Shipping Orders'))

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Shipping Orders')
        </x-slot>

        <x-slot name="body">
            <livewire:orders-table status="shipping" />
        </x-slot>
    </x-backend.card>
@endsection
