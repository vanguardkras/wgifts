@extends('layouts.app')

@section('content')
    <button class="button_change" id="instruction">Инструкция</button>
    <form action="/{{ Auth::check() ? 'lists' : 'create' }}" method="post">
        @csrf
        <table class="list_edit">
            <tr>
                <th>
                    <label for="domain">Ссылка</label>
                    <span class="help" help="{{ __('help.domain') }}">?</span>
                </th>
                <td>
                    <input class="{{ $errors->has('domain') ? 'alert' : '' }}" id="domain" type="text" name="domain"
                           value="{{ old('domain') ?? (session('created')->domain ?? '') }}"
                           placeholder="vasha_ssilka"
                           required>
                    @error('domain')
                    <span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label for="title">Название</label>
                    <span class="help" help="{{ __('help.title') }}">?</span>
                </th>
                <td>
                    <input class="{{ $errors->has('title') ? 'alert' : '' }}" id="title" type="text" name="title"
                           value="{{ old('title') ?? (session('created')->title ?? '') }}"
                           placeholder="Свадьба Петровых"
                           required>
                    @error('title')
                    <span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label for="date">Дата</label>
                    <span class="help" help="{{ __('help.date') }}">?</span>
                </th>
                <td>
                    <input class="{{ $errors->has('date') ? 'alert' : '' }}" id="date" type="date" name="date"
                           value="{{ old('date') ?? ((session('created')->date ?? null) ?? now()->toDateString()) }}"
                           required>
                    @error('date')
                    <br><span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label for="background">Тема</label>
                    <span class="help" help="{{ __('help.theme') }}">?</span>
                </th>
                <td>
                    @foreach($backgrounds as $background)
                        <label>
                            <input type="radio" name="background_id"
                                   value="{{ $background->id }}"
                                {{ old('background_id') == $background->id ? 'checked' : ((session('created')->background_id ?? null) == $background->id ? 'checked' : $loop->first ? 'checked' : '') }}>
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
                    <label for="information">Описание</label>
                    <span class="help" help="{{ __('help.information') }}">?</span>
                </th>
                <td>
                    <textarea class="{{ $errors->has('information') ? 'alert' : '' }}" id="information"
                              name="information"
                              placeholder="У нас скоро свадьба, и мы хотели бы получить следующие подарки.">{{ old('information') ?? (session('created')->information ?? '') }}</textarea>
                    @error('information')
                    <span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
        </table>
        <table class="list_edit_save">
            <tr>
                <th>
                    Включить коментарии
                    <span class="help" help="{{ __('help.comment') }}">?</span>
                </th>
                <td style="border-bottom: none">
                    <label class="checkbox">
                        <input type="checkbox" value=1
                               name="comment_opt"{{ old('comment_opt') ? ' checked' : ((session('created')->comment_opt ?? null) ? ' checked' : '') }}>
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>
                    <input class="button" type="submit" value="{{ Auth::check() ? 'Создать' : 'Далее' }}">
                </td>
            </tr>
        </table>
    </form>
@endsection
