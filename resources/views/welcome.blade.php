@extends('layouts.app')

@section('meta')
    <meta name="description" content="@lang('info.meta')">

@endsection

@section('content')
    <div class="info">
        <div class="main_image">
            <img src="/images/background.webp" alt="bg">
        </div>
        <div class="information">
            <h1>@lang('info.header')</h1>
            <p class="text">
                @lang('info.text')
            </p>
            <ol>
                @lang('info.actions')
            </ol>
            <p class="text">
                @lang('info.example_to_see') <a href="https://podarimne.site/test" target="_blank">@lang('info.example')</a>
            </p>
            <p>@lang('info.try_now')</p>
            <div class="button_holder">
                <a class="button" href="/list/create">@lang('buttons.create_list')</a>
            </div>
            <p class="tiny_link">
                <a href="mailto:championing@mail.ru">@lang('info.any_questions')</a>
            </p>
        </div>
    </div>
@endsection
