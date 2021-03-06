@extends('backend.layouts.app')

@section('title', __('Deleted Blogs'))

@section('breadcrumb-links')
    @include('backend.blog.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Blogs')
        </x-slot>

        <x-slot name="body">
            <livewire:blogs-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
