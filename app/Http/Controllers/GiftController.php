<?php

namespace App\Http\Controllers;

use App\Gift;
use App\GiftList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GiftController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

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

        return redirect('/lists/'.$gift->giftList->id.'/edit');
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
}
