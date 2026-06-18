@extends('layouts.app')

@section('title', __('Main page'))

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="mb-12">
            <p class="text-lg text-gray-600 max-w-3xl">
                {{ __('welcome.description') }}
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 mb-12">

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <dt class="text-lg font-semibold text-gray-900 mb-2">
                    {{ __('common.tasks') }}
                </dt>
                <dd class="text-sm text-gray-600">
                    {{ __('welcome.tasks.description') }}
                </dd>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <dt class="text-lg font-semibold text-gray-900 mb-2">
                    {{ __('common.statuses') }}
                </dt>
                <dd class="text-sm text-gray-600">
                    {{ __('welcome.statuses.description') }}
                </dd>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <dt class="text-lg font-semibold text-gray-900 mb-2">
                    {{ __('common.labels') }}
                </dt>
                <dd class="text-sm text-gray-600">
                    {{ __('welcome.labels.description') }}
                </dd>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <dt class="text-lg font-semibold text-gray-900 mb-2">
                    {{ __('common.users') }}
                </dt>
                <dd class="text-sm text-gray-600">
                    {{ __('welcome.users.description') }}
                </dd>
            </div>

        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="text-sm text-lg font-semibold text-gray-500">
                    {{ __('common.tasks') }}
                </div>
                <div class="mt-2 text-3xl font-bold text-gray-900">
                    {{ $tasksCount }}
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="text-sm text-lg font-semibold text-gray-500">
                    {{ __('common.statuses') }}
                </div>
                <div class="mt-2 text-3xl font-bold text-gray-900">
                    {{ $statusesCount }}
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="text-sm text-lg font-semibold text-gray-500">
                    {{ __('common.labels') }}
                </div>
                <div class="mt-2 text-3xl font-bold text-gray-900">
                    {{ $labelsCount }}
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="text-sm text-lg font-semibold text-gray-500">
                    {{ __('common.users') }}
                </div>
                <div class="mt-2 text-3xl font-bold text-gray-900">
                    {{ $usersCount }}
                </div>
            </div>

        </div>

    </div>
@endsection
