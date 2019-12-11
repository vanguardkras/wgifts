@extends('layouts.app')

@section('content')
    <button class="button_change" id="instruction">Инструкция</button>
    <div class="info">
        <div class="description">
            <p class="text">
                На этой странице Вы можете создать список подарков.
            </p>
            <p class="text">
                <span class="white">Ссылка</span><br>
                Придумайте уникальную ссылку, которую Вы отправите
                своим друзьям и родственникам. Ссылка должна быть на латинице и не содержать пробелов
                и специальных символов.
            </p>
            <p class="text">
                <span class="white">Название</span><br>
                Укажите название Вашего мероприятия.
                Это название будет отображаться в заголовке Вашего личного списка.
            </p>
            <p class="text">
                <span class="white">Дата</span><br>
                Выберите дату, когда будет проходить Ваш праздник.
            </p>
            <p class="text">
                <span class="white">Тема</span><br>
                Оформите Ваш список понравившимся изображением.
            </p>
            <p class="text">
                <span class="white">Описание</span><br>
                Вы можете добавить описание Вашего мероприятия. Оно также будет отображаться в Вашем списке.
            </p>
            <p class="text">
                <span class="white">Коментарии</span><br>
                Вы можете дать возможность вашим знакомым оставлять коментарий, при выборе подарка.
                Например, они могут подписать, кто его выбрал, или оставить пожелание.
            </p>
            <p class="text">
                <span class="white">Заключение</span><br>
                Все настройки можно отредактировать позже.
            </p>
        </div>
        <div class="w-flex-70">
            <form action="/lists" method="post">
                @csrf
                <table class="list_edit">
                    <tr>
                        <th><label for="domain">Ссылка</label></th>
                        <td>
                            <input id="domain" type="text" name="domain" value="{{ old('domain') }}"
                                   placeholder="vasha_ssilka"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Название</label></th>
                        <td>
                            <input id="title" type="text" name="title" value="{{ old('title') }}"
                                   placeholder="Свадьба Петровых"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="date">Дата</label></th>
                        <td>
                            <input id="date" type="date" name="date" value="{{ old('date') ?? now()->toDateString() }}"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="background">Тема</label></th>
                        <td>
                            @foreach($backgrounds as $background)
                                <label>
                                    <input type="radio" name="background_id"
                                           value="{{ $background->id }}"{{ $loop->first ? ' checked' : ''}}>
                                    <div class="image_variants">
                                        <span class="radio_image_label">{{ $background->name }}</span>
                                        <img src="/storage/backgrounds/{{ $background->file }}" alt="image">
                                    </div>
                                </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th><label for="information">Описание</label></th>
                        <td>
                            <textarea id="information" name="information"
                                      placeholder="У нас скоро свадьба, и мы хотели бы получить следующие подарки.">{{ old('information') }}</textarea>
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
                                       name="comment_opt"{{ old('comment_opt') ? ' checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <input class="button" type="submit" value="Создать">
                        </td>
                    </tr>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <tr>
                                <td colspan="2">
                                    <span class="alert">{{ $error }}</span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </form>
        </div>
    </div>
@endsection
