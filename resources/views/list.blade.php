@component('layouts.gift')
    @if(isset($no_action))
        <script>
            let no_action = true;
        </script>
    @endif
    <div>
        <img src="{{ asset('storage/backgrounds/'.\App\Background::find($list->background_id)->file) }}" alt="background">
    </div>
    <h1>{{ $list->title }}</h1>
    <h2>{{ date('d.m.Y', strtotime($list->date)) }}</h2>
    <p>{{ $list->information }}</p>
    <div>
        <table>
            @foreach($list->gifts as $key => $gift)
                <tr>
                    @include('gift')
                </tr>
            @endforeach
        </table>
    </div>
@endcomponent
