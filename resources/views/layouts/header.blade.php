<div class="login">
    @guest
        <a href="{{ route('register') }}">Регистрация</a> |
        <a href="{{ route('login') }}">Вход</a>
    @endguest
    @auth
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="logout" type="submit">Выход</button>
        </form>
    @endauth
</div>
<div class="header">
    <div class="logo">
        <a href="/">Подари Мне</a>
    </div>
    @include('menu.main')
</div>
