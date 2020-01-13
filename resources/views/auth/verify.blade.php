@extends('layouts.app')

@section('content')

    @if (session('resent'))
        <div>
            @lang('A fresh verification link has been sent to your email address.')
        </div>
    @endif
    <div>
        @lang('Before proceeding, please check your email for a verification link.')
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button class="button_change" type="submit">@lang('click here to request another')</button>.
        </form>
    </div>
@endsection
