@extends('backend.layouts.app')

@section('title', __('Deleted Categories'))

@section('breadcrumb-links')
    @include('backend.category.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Categories')
        </x-slot>

        <x-slot name="body">
            <livewire:categories-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
