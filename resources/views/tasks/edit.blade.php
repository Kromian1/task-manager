@extends('layouts.app')

@section('title', __('Edit task'))

@section('header', __('Edit task'))

@section('content')
    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->open() }}
    @include('tasks.form')

    <div class="mt-3">
        {{ html()->submit(__('Update'))->class('btn btn-primary') }}
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            {{ __('Cancel') }}
        </a>
    </div>
    {{ html()->closeModelForm() }}
@endsection
