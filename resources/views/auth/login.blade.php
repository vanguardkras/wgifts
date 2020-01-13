@extends('layouts.app')

@section('content')
    <form class="auth" method="POST" action="{{ route('login') }}">
        @csrf
        <h2>{{ __('auth.login') }}</h2>
        <div>
            <label for="email">E-Mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div>
            <label for="password">@lang('auth.password')</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
            <span class="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div>
            <label class="checkbox">
                <input type="checkbox" value=1 name="remember"{{ old('remember') ? ' checked' : '' }}>
            <span class="checkmark"></span>
                @lang('auth.remember_me')</label>
        </div>

        <div>
            <button class="button" type="submit">@lang('auth.login')</button>
        </div>

        <div>
            <p><a href="{{ route('register') }}">@lang('auth.register')</a></p>
            <p><a href="{{ route('password.request') }}">@lang('auth.forget_password')</a></p>
        </div>
    </form>
@endsection
