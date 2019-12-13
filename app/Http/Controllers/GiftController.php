<?php

namespace App\Http\Controllers;

use App\Gift;
use App\GiftList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GiftController extends Controller
{
    /**
     * Store a newly created gift.
     *
     * @param Request $request
     * @param GiftList $giftList
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, GiftList $giftList)
    {
        $this->authorize('userAllowed', $giftList);

        $gift = new Gift;
        $gift->gift_list_id = $giftList->id;
        $gift->name = $request->name;
        $gift->save();

        return 'OK';
    }

    /**
     * Store a newly created gift for an unauthorized user.
     *
     * @param Request $request
     * @return string
     */
    public function storeToSession(Request $request)
    {
        $list = session('created');

        $gift = new \stdClass;
        $gift->name = $request->name;
        $gift->picked = false;
        $gift->comment = '';

        $list->gifts[] = $gift;

        session()->put('created', $list);

        return 'OK';
    }

    /**
     * Update the gift name.
     *
     * @param Request $request
     * @param Gift $gift
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Gift $gift)
    {
        $this->authorize('change', $gift);

        $gift->name = $request->name;
        $gift->save();
    }

    /**
     * Update gift for unauthorized users.
     *
     * @param Request $request
     */
    public function updateInSession(Request $request)
    {
        $list = session('created');
        $list->gifts[$request->id]->name = $request->name;

        session()->put('created', $list);
    }

    /**
     * Remove a gift.
     *
     * @param Gift $gift
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Gift $gift)
    {
        $this->authorize('change', $gift);

        $gift->delete();

        return 'OK';
    }

    public function destroyInSession(Request $request, $id)
    {
        $list = session('created');
        unset($list->gifts[$request->id]);
        session()->put('created', $list);
        return 'OK';
    }
}
