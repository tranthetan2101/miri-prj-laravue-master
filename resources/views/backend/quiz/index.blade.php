@extends('backend.layouts.app')

@section('title', __('Quản lý câu hỏi tư vấn'))

@section('breadcrumb-links')
    @include('backend.quiz.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Quản lý câu hỏi tư vấn')
        </x-slot>

        <x-slot name="body">
            <livewire:quizzes-table />
        </x-slot>
    </x-backend.card>
@endsection
