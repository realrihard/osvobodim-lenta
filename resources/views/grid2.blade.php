@extends('layouts.app')

@section('content')
    <div class="header">
        <div>
            <h1>Вариант 2</h1>
        </div>
    </div>

    <div id="gallery_2">
        @foreach ($posts as $post)
            <img src="/images/{{ $post->image }}">
        @endforeach
    </div>
@endsection
