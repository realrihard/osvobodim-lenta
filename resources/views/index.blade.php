@extends('app')

@section('content')
    <div class="header">
        <div>
            <h1>Application Title</h1>
        </div>
        <div>
            <a href="{{ url('create') }}">Create new post</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Discription</th>
                <th>Suma</th>
                <th>Image</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->suma }}</td>
                    <td><img src="/images/{{ $post->image }}" width="100px"></td>
                    <td>
                        <form action="" method="POST">
                            <a href="#">Show</a>
                            <a href="#">Edit</a>

                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
