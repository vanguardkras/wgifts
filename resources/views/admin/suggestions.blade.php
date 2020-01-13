@extends('admin.layouts.app')

@section('content')
    <h3>Фановые подарки</h3>
    <table>
        <tr>
            <th>English</th>
            <th>Русский</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <form action="/admin/suggestions" method="post">
                @csrf
                <td>
                    <input type="text" name="gift" required>
                </td>
                <td>
                    <input type="text" name="gift_ru" required>
                </td>
                <td>
                    <input type="submit" value="Добавить">
                </td>
            </form>
        </tr>
        @foreach ($suggestions as $suggestion)
            <tr>
                <form action="/admin/suggestions/{{ $suggestion->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <td>
                        <input type="text" name="gift" value="{{ $suggestion->gift }}">
                    </td>
                    <td>
                        <input type="text" name="gift_ru" value="{{ $suggestion->gift_ru }}">
                    </td>
                    <td>
                        <input type="submit" value="Изменить">
                    </td>
                </form>
                <td>
                    <form action="/admin/suggestions/{{ $suggestion->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Удалить">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $suggestions->links() }}
@endsection('content')
