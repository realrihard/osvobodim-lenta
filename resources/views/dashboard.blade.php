@extends('layouts.admin')

@section('content')
    <div id="app">
        <Smoothie class="content">
            <div class="container">
                <div class="header">
                    <ul class="header__menu">
                        <li>
                            <a href="/">Перейти на сайт</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            {{ Auth::user()->name }}

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
                        </li>
                    </ul>
                </div>
            </div>

            <dashboard />
        </Smoothie>

        <post-panel />
    </div>
@endsection
