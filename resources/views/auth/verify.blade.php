@extends('layouts.app')

@section('content')

    @if (session('resent'))
        <div>
            Ссылка для подтверждения отправлена на ваш почтовый ящик.
        </div>
    @endif
    <div>
        Перед продолжением, пожалуйста, проверьте свою почту.
        Если вы не получили сообщение,
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button class="button_change" type="submit">щелкните здесь, чтобы повторить отправку</button>.
        </form>
    </div>
@endsection
