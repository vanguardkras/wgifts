<nav>
    <li><a href="/list/create">@lang('app.menu.create_list')</a></li>
    <li><a href="/">@lang('app.menu.main')</a></li>
    @auth
        <li><a href="/lists">@lang('app.menu.my_lists')</a></li>
    @endauth
</nav>
