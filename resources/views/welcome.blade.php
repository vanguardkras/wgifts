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
                У Вас скоро свадьба, день рождения, или другой праздник?<br>
                <b>На этот раз вы сможете получить то, что хотите!</b><br>
                Кто знает лучше Вас, что Вам нужно?
            </p>
            <p class="text">
                С помощью нашего сервиса Вы сможете ссотавить <b>список подарков</b>,
                которые Вы хотели бы получить.
            </p>
            <p class="text">
                Затем Вы сможете отправить <b>уникальную ссылку</b> со списком подарков Вашим родственникам, друзьям и знакомым.<br>
                Таким образом, они смогут не только узнать, что Вы хотите, но и забронировать за собой любой подарок из Вашего списка.
            </p>
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
