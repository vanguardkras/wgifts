@foreach($giftList->gifts as $key => $gift)
    <tr>
        <input type="hidden" name="id" value="{{ Auth::check() ? $gift->id : $key }}">
        <td>{{ $loop->iteration }}.</td>
        <td>
            <input class="gift{{ $gift->picked ? ' success' : '' }}" type="text" name="name"
                   value="{{ $gift->name }}"{{ $gift->picked ? ' disabled' : '' }} autocomplete="off">
        </td>
        @if ($gift->picked)
            <td></td>
            @if($giftList->comment_opt)
                <td class="comment">
                    {{ $gift->comment }}
                </td>
            @endif
        @else
            <td>
                <input class="material-icons edit" type="button" value="edit"
                       title="@lang('buttons.modify')">
            </td>
            <td>
                <input class="material-icons delete" type="button"
                       value="delete_forever" title="@lang('buttons.delete')">
            </td>
        @endif
    </tr>
@endforeach
