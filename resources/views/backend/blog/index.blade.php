@extends('backend.layouts.app')

@section('title', __('Blog Management'))

@section('breadcrumb-links')
    @include('backend.blog.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Blog Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.blog.create')"
                    :text="__('Create Blog')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:blogs-table />
        </x-slot>
    </x-backend.card>
@endsection
