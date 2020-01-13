@extends('layouts.app')

@section('content')
    <h3>@lang('info.your_lists')</h3>
    <table class="lists">
        @foreach($lists as $list)
            <form action="/lists/{{ $list->id }}" method="post">
                @method('DELETE')
                @csrf
                <tr>
                    <td>
                        <a
                            href="/lists/{{ $list->id }}/edit_list"
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
                        <input type="text" value="{{ config('app.url').'/'.($list->domain) }}">
                        <input class="copy-icon material-icons edit" type="button" value="file_copy"
                               title="@lang('buttons.copy_to_cb')">
                        <input class="share-icon material-icons edit" type="button" value="share"
                               title="@lang('buttons.share')">
                        @include('helpers.preview')
                        <input class="eye material-icons edit" type="button" value="remove_red_eye"
                               title="@lang('buttons.preview')">
                        <a class="material-icons edit"
                           href="{{ config('app.url').'/lists/'.($list->id).'/edit' }}"
                           title="@lang('info.your_lists')">settings_applications</a>
                        <input onclick="return confirm('@lang('info.sure_want_delete')')"
                               class="material-icons delete"
                               type="submit" value="delete_forever" title="@lang('buttons.delete')">
                        @include('helpers.social_share', ['list' => $list])
                        @if ($list->isOutdated())
                            <span class="alert shifted">@lang('info.end')</span>
                        @endif
                    </td>
                </tr>
            </form>
        @endforeach
    </table>
@endsection
