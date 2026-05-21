@extends('layouts.app')

@section('title', 'Статусы задач')

@section('header', 'Статусы задач')

@section('content')
    <div>
        <h1>Статусы задач</h1>
        <a href="{{ route('task_statuses.create') }}">Создать статус</a>
    </div>
    <div>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
                @foreach($taskStatuses as $status)
                    <tr>
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>
                            <a href="{{ route('task_statuses.edit', $status) }}">Изменить</a>
                            {{ html()->modelForm($status, 'DELETE', route('task_statuses.destroy', $status))->open() }}
                                {{ html()->submit('Удалить')->attribute('onclick', 'return confirm (\'Вы уверены?\'') }}
                            {{ html()->closeModelForm() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
