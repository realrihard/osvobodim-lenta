@extends('layouts.app')

@section('content')
    <div class="header">
        <div>
            <h1>User part</h1>
        </div>
    </div>

    <div id="app">
        <waterfall-gallery :columns="3" />
    </div>
@endsection
