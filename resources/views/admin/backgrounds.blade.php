@extends('admin.layouts.app')

@section('content')
    <h3>Конфигурация фонов</h3>
    <table>
        <tr>
            <th>Имя</th>
            <th>Файл</th>
            <th colspan="2">Действия</th>
        </tr>
        @foreach($backgrounds as $background)
            <tr>
                <form action="/admin/edit_background/{{ $background->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <td><input type="text" name="name" value="{{ $background->name }}"></td>
                    <td>
                        <img style="width: 200px" src="/storage/backgrounds/{{ $background->file }}"><br>
                        <input type="file" name="file">
                    </td>
                    <td>
                        <input class="material-icons edit" type="submit" value="edit"
                               title="Изменить">
                    </td>
                </form>
                <form action="/admin/delete_background/{{ $background->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <td>
                        <input class="material-icons delete" type="submit"
                               value="delete_forever" title="Удалить">
                    </td>
                </form>
            </tr>
        @endforeach
    </table>
    <h3>Загрузить новый</h3>
    <table>
        <tr>
            <form action="/admin/store_background" method="post" enctype="multipart/form-data">
                @csrf
                <td>
                    <input type="text" name="name" required>
                </td>
                <td>
                    <input type="file" name="file" accept="image/jpeg,image/png,image/gif" required>
                </td>
                <td>
                    <input class="material-icons edit" type="submit"
                            value="cloud_upload" title="Загрузить">
                </td>
            </form>
        </tr>
    </table>
@endsection('content')
