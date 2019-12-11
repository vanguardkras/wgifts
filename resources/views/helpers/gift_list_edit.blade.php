@foreach($giftList->gifts as $gift)
    <tr>
        <input type="hidden" name="id" value="{{ $gift->id }}">
        <td>{{ $loop->iteration }}</td>
        <td>
            <input class="gift{{ $gift->picked ? ' success' : '' }}" type="text" name="name"
                   value="{{ $gift->name }}"{{ $gift->picked ? ' disabled' : '' }}>
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
                       title="Изменить">
            </td>
            <td>
                <input class="material-icons delete" type="button"
                       value="delete_forever" title="Удалить">
            </td>
        @endif
    </tr>
@endforeach
