<td class="{{ $gift->picked ? 'inactive' : '' }} gift-name">{{ $gift->name }}</td>
@if ($list->comment_opt && !$gift->picked)
    <td class="comment">
        <input type="text" name="comment" value="{{ $gift->comment }}"
               placeholder="@lang('buttons.comment_placeholder')"
               maxlength="10">
    </td>
@endif
<td>
    @if ($gift->picked)
        <span class="green">&#10004;</span>
    @else
            <input type="hidden" name="id" value="{{ $gift->id ?? $key }}">
            <input type="button" value="@lang('buttons.pick')">
    @endif
</td>
