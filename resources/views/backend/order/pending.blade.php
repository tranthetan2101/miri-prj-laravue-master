@extends('backend.layouts.app')

@section('title', __('Pending Orders'))

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Pending Orders')
        </x-slot>

        <x-slot name="body">
            <livewire:orders-table status="pending" />
        </x-slot>
    </x-backend.card>
@endsection
