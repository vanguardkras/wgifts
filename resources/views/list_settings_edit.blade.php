@extends('layouts.app')

@section('content')
    @include('helpers.suggestion')
    <a href="{{ config('app.url').'/lists/'.($giftList->id).'/edit_list' }}">@lang('info.back_to_list_edit')</a>
    @isPaymentRequired
    @if(!$giftList->activated)
        <br><span class="alert">@lang('info.not_active')</span>
    @endif
    @endisPaymentRequired
    <form action="/lists/{{ $giftList->id }}" method="post">
        @method('PATCH')
        @csrf
        <table class="list_edit">
            <tr>
                <th>
                    <label for="domain">@lang('info.link')</label>
                </th>
                <td>
                    <input class="{{ $errors->has('domain') ? 'alert' : '' }}" type="text" name="domain"
                           value="{{ $giftList->domain }}" required>
                    @error('domain')
                        <span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label for="title">@lang('info.title')</label>
                </th>
                <td>
                    <input class="{{ $errors->has('title') ? 'alert' : '' }}" type="text" name="title"
                           value="{{ $giftList->title }}" required>
                    @error('title')
                        <span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label for="background">@lang('info.theme')</label>
                </th>
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
                <th>
                    <label for="information">@lang('info.description')</label>
                </th>
                <td>
                    <textarea class="{{ $errors->has('date') ?? 'information' }}"
                              name="information">{{ $giftList->information }}</textarea>
                    @error('information')
                        <span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
        </table>
        <table class="list_edit_save">
            <tr>
                <th>
                    @lang('info.turn_on_comments')
                    <span class="help" help="{{ __('help.comment') }}">?</span>
                </th>
                <td style="border-bottom: none">
                    <label class="checkbox">
                        <input type="checkbox" value=1
                               name="comment_opt"{{ $giftList->comment_opt ? ' checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>
                    <input class="button_change" type="submit" value="@lang('buttons.modify')">
                </td>
            </tr>
        </table>
    </form>
    @isPaymentRequired
    @if(!$giftList->activated)
        @include('helpers.yandex_form')
    @endif
    @endisPaymentRequired
@endsection
