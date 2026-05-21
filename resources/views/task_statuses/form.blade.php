@if ($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ html()->label('Название', 'name') }}<br>
{{ html()->input('text', 'name') }}<br>
