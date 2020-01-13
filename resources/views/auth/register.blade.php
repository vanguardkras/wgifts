@extends('layouts.app')

@section('content')
    <form class="auth" method="POST" action="{{ route('register') }}">
        @csrf
        <p>@lang('auth.message')</p>
        <h2>@lang('auth.registration')</h2>

        <div>
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div>
            <label for="password">@lang('auth.password')</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
            <span class="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div>
            <label for="password-confirm">@lang('passwords.pass_ack_label')</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="center_content">
            <button class="button" type="submit">@lang('auth.register')</button>
        </div>

    </form>
@endsection
