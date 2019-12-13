@extends('layouts.app')

@section('meta')
    <meta name="description" content="Сайт для создания списка подарков к празднику, чтобы потом поделиться им
со своими знакомыми">

@endsection

@section('content')
    <div class="info">
        <div class="main_image">
            <img src="/images/background.webp" alt="bg">
        </div>
        <div class="information">
            <h1>Закажи себе подарок</h1>
            <p class="text">
                <b>У Вас скоро праздник?</b><br>
                На этот раз вы сможете получить, что хотите!<br>
                Создайте свой мини-сайт со списком подарков и позвольте знакомым выбрать.
            </p>
            <ol>
                <li>Создате и оформите список</li>
                <li>Наполните его подарками</li>
                <li>Поделитесь ссылкой со знакомыми</li>
                <li>Ждите нужных подарков на праздник!</li>
            </ol>
            <p class="text">
                Посмотреть пример готового списка можно здесь: <a href="https://podarimne.site/test" target="_blank">пример</a>
            </p>
            <p>
                Попробуйте наш сервис прямо сейчас.
            </p>
            <div class="button_holder">
                <a class="button" href="/list/create">Создать список</a>
            </div>
            <p class="tiny_link">
                <a href="mailto:championing@mail.ru">Остались вопросы? Свяжитесь с нами.</a>
            </p>
        </div>
    </div>
@endsection
