<?php

namespace App\Http\Controllers;

use App\GiftList;
use App\Setting;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Activation request handler after payment.
     *
     * @param Request $request
     */
    public function activate(Request $request)
    {
        if ($this->checkValidity($request)) {
            $list = GiftList::find($request->label);
            $list->activate();
        }
    }

    /**
     * Check current request validity according to Yandex documentation.
     *
     * @param Request $request
     * @return bool
     */
    protected function checkValidity(Request $request): bool
    {
        $params = implode('&', [
            $request->notification_type,
            $request->operation_id,
            $request->amount,
            $request->currency,
            $request->datetime,
            $request->sender,
            $request->codepro,
            config('app.yandex_notification_secret'),
            $request->label,
        ]);
        $sha1 = sha1($params);

        $price = Setting::getPrice();

        return ($sha1 === $request->sha1_hash) && ($price >= (int) $request->withdraw_amount);
    }
}
