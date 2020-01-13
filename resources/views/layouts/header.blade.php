<div class="login">
    @guest
        <a href="{{ route('register') }}">@lang('auth.registration')</a> |
        <a href="{{ route('login') }}">@lang('auth.login')</a>
    @endguest
    @auth
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="logout" type="submit">@lang('auth.logout')</button>
        </form>
    @endauth
</div>
<div class="header">
    <div class="logo">
        <a href="/">@lang('app.name')</a>
    </div>
    @include('menu.main')
</div>
