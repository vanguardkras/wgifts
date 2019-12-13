@component('layouts.gift')
    @if(isset($no_action))
        <script>
            let no_action = true;
        </script>
    @endif
    <div>
        <img src="{{ asset('storage/backgrounds/'.$list->background->file) }}" alt="фон">
    </div>
    <h1>{{ $list->title }}</h1>
    <h2>{{ $list->beautifulDate() }}</h2>
    <p>{{ $list->information }}</p>
    <div>
        <table>
            @foreach($list->gifts as $gift)
                <tr>
                    @include('gift')
                </tr>
            @endforeach
        </table>
    </div>
@endcomponent
