@extends('layouts.app')

@section('content')
    <script>
        let isAuth = {{ Auth::check() ? 'true' : 'false' }};
    </script>
    @include('helpers.suggestion')
    <div class="info">
        <div class="list">
            <div class="description no_hide p-0">
                <h4>{{ $giftList->title }}</h4>
                @isPaymentRequired
                @if(!$giftList->activated)
                    <h4 class="alert">(Не активирован)</h4>
                @endif
                @endisPaymentRequired
                <p class="text">
                    Добавьте подарки и поделитесь ссылкой с друзьями.
                </p>
                <button class="button_change m-bot-20" id="suggest">Получить рекомендацию</button>
            </div>
            {{-- Adding gift --}}
            @auth
                <input type="hidden" name="list_id" value="{{ $giftList->id }}">
            @endauth
            <input class="gift_name" type="text" name="name" placeholder="То, что я хочу" required>
            <input id="add_gift" class="button" type="button" value="Добавить">
            {{-- Gifts section --}}
            <table class="gifts_edit m-top-30" id="gifts_edit">
                @include('helpers.gift_list_edit')
            </table>
            <div class="share">
                <h4>Поделиться</h4>
                <input type="text" value="{{ config('app.url').'/'.($giftList->domain) }}" @guest disabled @endguest>
                @include('helpers.preview', ['list' => $giftList])
                <input class="eye material-icons edit" type="button" value="remove_red_eye"
                       title="Предпросмотр">
                @auth
                    <input class="copy-icon material-icons edit" type="button" value="file_copy"
                           title="Копировать в буфер обмена">
                    <input class="share-icon material-icons edit" type="button" value="share"
                           title="Поделиться">
                @endauth
                <a class="material-icons edit"
                   @auth
                   href="{{ config('app.url').'/lists/'.($giftList->id).'/edit' }}"
                   @else
                   href="/list/create"
                   @endauth
                   title="Настройки списка">settings_applications</a>
                @auth
                    @include('helpers.social_share', ['list' => $giftList])
                @endauth
            </div>
            <div class="save">
                @auth
                    @isPaymentRequired
                    @if(!$giftList->activated)
                        @include('helpers.yandex_form')
                    @endif
                    @endisPaymentRequired
                @else
                    <a class="button_change" href="{{ config('app.url').'/register' }}">Сохранить</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
