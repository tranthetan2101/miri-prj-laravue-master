@extends('backend.layouts.app')

@section('title', __('Completed Orders'))

@section('breadcrumb-links')
    @include('backend.order.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Completed Orders')
        </x-slot>

        <x-slot name="body">
            <livewire:orders-table status="completed" />
        </x-slot>
    </x-backend.card>
@endsection
