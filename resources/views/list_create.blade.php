@extends('layouts.app')

@section('content')
    Чтобы увидеть описание полей, наведите на <span class="help" help="Информация">?</span>
    <form action="/{{ Auth::check() ? 'lists' : 'create' }}" method="post">
        @csrf
        <table class="list_edit">
            <tr>
                <th>
                    <label for="title">Название</label>
                </th>
                <td>
                    <input class="{{ $errors->has('title') ? 'alert' : '' }}" id="title" type="text" name="title"
                           value="{{ old('title') ?? (session('created')->title ?? '') }}"
                           placeholder="Название мероприятия"
                           required>
                    @error('title')
                    <span class="alert">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>
                    <label for="date">Дата</label>
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
                </th>
                <td>
                    <textarea class="{{ $errors->has('information') ? 'alert' : '' }}" id="information"
                              name="information"
                              placeholder="Вы можете добавить описание своего мероприятия. Оно также будет отображаться в Вашем списке.">{{ old('information') ?? (session('created')->information ?? '') }}</textarea>
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
