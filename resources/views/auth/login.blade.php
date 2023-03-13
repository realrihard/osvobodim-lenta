@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="login__wrapper">
            <div class="login__block">
                <div class="login__header">
                    <div class="login__logo">
                        <img src="{{ asset('images/assets/logo.svg') }}" alt="">
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form__group">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Логин (Email)') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid__feedback" role="alert">
                                Такого пользователя не существует или вы ошиблись при вводе
                            </span>
                        @enderror
                    </div>
                    <div class="form__group">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn__form btn_primary">
                            {{ __('Войти') }}
                        </button>

                        @if (Route::has('password.request'))
                            <!--<a class="btn btn-link" href="{{ route('password.request') }}">
                                                                                        {{ __('Forgot Your Password?') }}
                                                                                    </a>-->
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
