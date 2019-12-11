@extends('layouts.app')

@section('content')
    @include('helpers.suggestion')
    <div class="info">
        <div class="w-flex-60 list">
            <div class="description no_hide p-0">
                <p class="text">
                    Создайте здесь Ваш список и поделитесь ссылкой с друзьями.
                </p>
                <button class="button_change m-bot-20" id="suggest">Необычный подарок</button>
            </div>
            {{-- Adding gift form --}}
            <form action="/{{ $giftList->id }}/gift" method="post">
                @csrf
                <input type="hidden" name="list_id" value="{{ $giftList->id }}">
                <input class="gift_name" type="text" name="name" placeholder="То, что я хочу" required>
                <input id="add_gift" class="button" type="button" value="Добавить">
            </form>
            {{-- Gifts section --}}
            <table class="gifts_edit m-top-30" id="gifts_edit">
                @include('helpers.gift_list_edit')
            </table>
            <div class="share">
                <h4>Поделиться</h4>
                <input type="text" value="{{ config('app.url').'/'.($giftList->domain) }}">
                <a class="material-icons edit" target="__blank"
                   href="{{ config('app.url').'/'.($giftList->domain) }}">remove_red_eye</a>
                <input class="copy-icon material-icons edit" type="button" value="file_copy"
                       title="Копировать в буфер обмена">
                <input class="share-icon material-icons edit" type="button" value="share"
                       title="Поделиться">
                @include('helpers.social_share', ['list' => $giftList])
            </div>
        </div>
        <div class="w-flex-40">
            @isPaymentRequired
                @if(!$giftList->activated)
                <span class="alert">Не активирован</span>
                @endif
            @endisPaymentRequired
            <form action="/lists/{{ $giftList->id }}" method="post">
                @method('PATCH')
                @csrf
                <table class="list_edit">
                    <tr>
                        <th>Ссылка</th>
                        <td>
                            <input type="text" name="domain" value="{{ $giftList->domain }}" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Название</th>
                        <td>
                            <input type="hidden" name="date" value="{{ $giftList->date }}">
                            <input type="text" name="title" value="{{ $giftList->title }}" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Тема</th>
                        <td>
                            @foreach($backgrounds as $background)
                                <label>
                                    <input type="radio" name="background_id"
                                           value="{{ $background->id }}"{{ $background->id === $giftList->background_id ? ' checked' : ''}}>
                                    <div class="image_variants">
                                        <span class="radio_image_label">{{ $background->name }}</span>
                                        <img src="/storage/backgrounds/{{ $background->file }}" alt="image">
                                    </div>
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Описание</th>
                        <td>
                            <textarea name="information">{{ $giftList->information }}</textarea>
                        </td>
                    </tr>
                </table>
                <table class="list_edit_save">
                    <tr>
                        <th>
                            Включить коментарии
                        </th>
                        <td style="border-bottom: none">
                            <label class="checkbox">
                                <input type="checkbox" value=1
                                       name="comment_opt"{{ $giftList->comment_opt ? ' checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <input class="button_change" type="submit" value="Изменить">
                        </td>
                    </tr>
                </table>
            </form>
            @isPaymentRequired
                @if(!$giftList->activated)
                    @include('helpers.yandex_form')
                @endif
            @endisPaymentRequired
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
