@extends('layouts.app')

@section('title', __('Create task'))

@section('header', __('Create task'))

@section('content')
    {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
        @include('tasks.form')

    <div class="mt-4">
        {{ html()->submit(__('Create task'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    </div>
    {{ html()->closeModelForm() }}
@endsection
