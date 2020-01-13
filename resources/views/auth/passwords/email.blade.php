@extends('layouts.app')

@section('content')
    <form class="auth" method="POST" action="{{ route('password.email') }}">
        @csrf

            <div>
                @if (session('status'))
                    <div>
                        {{ session('status') }}
                    </div>
                @endif
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="center_content">
                <button class="button send_link" type="submit">
                    @lang('passwords.button_reset')
                </button>
            </div>
    </form>
@endsection
