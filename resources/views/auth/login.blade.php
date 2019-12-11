@extends('layouts.app')

@section('content')
    <form class="auth" method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Вход</h2>
        <div>
            <label for="email">E-Mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div>
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
            <span class="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div>
            <label class="checkbox">
                <input type="checkbox" value=1 name="remember"{{ old('remember') ? ' checked' : '' }}>
            <span class="checkmark"></span>
            Запомнить меня</label>
        </div>

        <div>
            <button class="button" type="submit">Войти</button>
        </div>

        <div>
            <p><a href="{{ route('register') }}">Регистрация</a></p>
            <p><a href="{{ route('password.request') }}">Забыли пароль</a></p>
        </div>
    </form>
@endsection
