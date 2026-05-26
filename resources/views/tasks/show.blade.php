@extends('layouts.app')

@section('title', __('Task'))

@section('header', __('Task'))

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ __('Task') }}</h1>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 border-b text-left">{{ __('Name') }}</th>
            </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $task->name }}</td>
                    <td class="px-6 py-4 space-x-2"></td>
                </tr>
            </tbody>
        </table>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 border-b text-left">{{ __('Status') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b">
                <td class="px-6 py-4">{{ $task->status->name ?? __('Without a status') }}</td>
                <td class="px-6 py-4 space-x-2"></td>
            </tr>
            </tbody>
        </table>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 border-b text-left">{{ __('Creator') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b">
                <td class="px-6 py-4">{{ $task->creator->name }}</td>
                <td class="px-6 py-4 space-x-2"></td>
            </tr>
            </tbody>
        </table>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 border-b text-left">{{ __('Executor') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b">
                <td class="px-6 py-4">{{ $task->assignee->name ?? __('Not assigned') }}</td>
                <td class="px-6 py-4 space-x-2"></td>
            </tr>
            </tbody>
        </table>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 border-b text-left">{{ __('Create date') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b">
                <td class="px-6 py-4">{{ $task->created_at->format('d.m.Y H:i') }}</td>
                <td class="px-6 py-4 space-x-2"></td>
            </tr>
            </tbody>
        </table>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 border-b text-left">{{ __('Description') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="border-b">
                <td class="px-6 py-4">{{ $task->description ?? __('Without a description') }}</td>
                <td class="px-6 py-4 space-x-2"></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
