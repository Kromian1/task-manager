@extends('layouts.app')

@section('title', 'Обновление статуса')

@section('header', 'Обновление статуса')

@section('content')
    {{ html()->modelForm($status, 'PATCH', route('task_statuses.update', $status))->open() }}
    @include('task_statuses.form')
    {{ html()->submit('Обновить')->class('btn btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
