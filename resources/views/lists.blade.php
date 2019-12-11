@extends('layouts.app')

@section('content')
    <h3>Ваши списки</h3>
    <table class="lists">
        @foreach($lists as $list)
            <form action="/lists/{{ $list->id }}" method="post">
                @method('DELETE')
                @csrf
                <tr>
                    <td>
                        <a
                            @if (!$list->isOutdated())
                            href="/lists/{{ $list->id }}/edit"
                            @endif
                            @isPaymentRequired
                            @if($list->activated)
                            class="activated"
                            @endif
                            @endisPaymentRequired
                        >
                            {{ $list->title }}
                        </a>
                    </td>
                    <td>
                        @if (!$list->isOutdated())
                            <input type="text" value="{{ config('app.url').'/'.($list->domain) }}">
                            <input class="copy-icon material-icons edit" type="button" value="file_copy"
                                   title="Копировать в буфер обмена">
                            <input class="share-icon material-icons edit" type="button" value="share"
                                   title="Поделиться">
                            <a class="material-icons edit" target="__blank" href="{{ config('app.url').'/'.($list->domain) }}">remove_red_eye</a>
                        @endif
                        <input onclick="return confirm('Вы уверены, что хотите удалить список?')"
                               class="material-icons delete"
                               type="submit" value="delete_forever" title="Удалить">
                        @include('helpers.social_share', ['list' => $list])
                        @if ($list->isOutdated())
                            <span class="alert shifted">Закончилось!</span>
                        @endif
                    </td>
                </tr>
            </form>
        @endforeach
    </table>
@endsection
