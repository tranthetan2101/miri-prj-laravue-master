@extends('backend.layouts.app')

@section('title', __('Deleted Sales'))

@section('breadcrumb-links')
    @include('backend.sale.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Sales')
        </x-slot>

        <x-slot name="body">
            <livewire:sales-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
