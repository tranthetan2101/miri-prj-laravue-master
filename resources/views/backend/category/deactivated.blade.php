@extends('backend.layouts.app')

@section('title', __('Deactivated Categories'))

@section('breadcrumb-links')
    @include('backend.category.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Categories')
        </x-slot>

        <x-slot name="body">
            <livewire:categories-table status="deactivated" />
        </x-slot>
    </x-backend.card>
@endsection
