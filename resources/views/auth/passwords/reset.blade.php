@extends('layouts.app')

@section('content')

    <form class="auth" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required>
            @error('email')
            {{ $message }}
            @enderror
        </div>

        <div>
            <label for="password">@lang('passwords.new_pass_label')</label>
            <input id="password" type="password" name="password" required>
            @error('password')
            {{ $message }}
            @enderror
        </div>

        <div>
            <label for="password-confirm">@lang('passwords.pass_ack_label')</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>

        <div class="center_content">
            <button type="submit" class="button">
                @lang('passwords.button_new_pass')
            </button>
        </div>
    </form>
@endsection
