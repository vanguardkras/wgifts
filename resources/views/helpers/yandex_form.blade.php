<p class="text m-top-30">
    Стоимость активации списка {{ $price }} рублей.
</p>
<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
    <input type="hidden" name="receiver" value="{{ config('app.yandex_wallet') }}">
    <input type="hidden" name="formcomment" value="{{ config('app.name') }}">
    <input type="hidden" name="short-dest" value="{{ config('app.name') }}">
    <input type="hidden" name="label" value="{{ $giftList->id }}">
    <input type="hidden" name="quickpay-form" value="shop">
    <input type="hidden" name="targets" value="Активация списка '{{ $giftList->title }}' на {{ config('app.name') }}">
    <input type="hidden" name="sum" value="{{ $price }}" data-type="number">
    <input type="hidden" name="paymentType" value="AC">
    <input class="button" type="submit" value="Активировать">
</form>
