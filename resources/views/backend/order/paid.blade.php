@extends('backend.layouts.app')

@section('title', __('Paid Orders'))

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Paid Orders')
        </x-slot>

        <x-slot name="body">
            <livewire:orders-table status="paid" />
        </x-slot>
    </x-backend.card>
@endsection
