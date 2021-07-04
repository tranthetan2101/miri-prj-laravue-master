@extends('backend.layouts.app')

@section('title', __('Combo Management'))

@section('breadcrumb-links')
    @include('backend.combo.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Combo Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.combo.create')"
                    :text="__('Create Combo')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:combos-table />
        </x-slot>
    </x-backend.card>
@endsection
