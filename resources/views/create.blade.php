@extends('layouts.admin')

@section('content')
    <div class="header">
        <h1>Create post</h1>
        <a href="/admin">Вернуться</a>
    </div>

    @if ($errors->any())
        <div>
            <strong>Woops!</strong> Something wrong <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="description" placeholder="Описание">
        <input type="text" name="suma" placeholder="Сумма">
        <input type="file" name="image">
        <button type="submit">Отправить</button>
    </form>
@endsection
