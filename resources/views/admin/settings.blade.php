@extends('admin.layouts.app')

@section('content')
    <h3>Конфигурации сайта</h3>
    <table class="settings">
        <tr>
            <th>Цена</th>
            <form action="/admin/update_price" method="post">
                @csrf
                @method('PATCH')
                <td><input type="number" name="price" value="{{ $price }}"></td>
                <td><input type="submit" value=" Изменить"></td>
            </form>
        </tr>
        <tr>
            <th>Необходима оплата</th>
            <form action="/admin/update_payment" method="post">
                @csrf
                @method('PATCH')
                <td>
                    <label for="required">Да</label>
                    <input id="required" type="radio" value="1"
                           name="paymentRequired"{{ $paymentRequired ? ' checked' : '' }}>
                    <label for="not_required">Нет</label>
                    <input id="not_required" type="radio" value="0"
                           name="paymentRequired"{{ !$paymentRequired ? ' checked' : '' }}>
                </td>
                <td><input type="submit" value=" Изменить"></td>
            </form>
        </tr>
    </table>
@endsection('content')
