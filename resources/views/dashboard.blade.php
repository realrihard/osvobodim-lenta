@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container">
            <div class="header">
                <ul class="header__menu">
                    <li>
                        <a href="/">Перейти на сайт</a>
                    </li>
                </ul>

                <!-- Authentication Links -->
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Выйти') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </div>
        </div>

        <div id="dashboard">

        </div>


    </div>
@endsection
