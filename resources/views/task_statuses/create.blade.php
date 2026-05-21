@extends('layouts.app')

@section('title', 'Создание статуса')

@section('header', 'Создание статуса')

@section('content')
    {{ html()->modelForm($status, 'POST', route('task_statuses.store'))->open() }}
        @include('task_statuses.form')
        {{ html()->submit('Создать') }}
    {{ html()->closeModelForm() }}
@endsection
