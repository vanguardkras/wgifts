<?php

namespace App\Http\Controllers;

use App\Gift;
use App\GiftList;
use App\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show a particular list for guests.
     *
     * @param string $giftListDomain
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showList(string $giftListDomain)
    {
        $list = GiftList::getByDomain($giftListDomain);
        $payment = Setting::isPaymentRequired();

        return ($payment && !$list->activated) || $list->isOutdated() ?
            abort('404') :
            view('list', compact('list'));
    }

    /**
     * Choose a gift.
     *
     * @param Request $request
     * @return mixed
     */
    public function giftChoose(Request $request)
    {
        $gift = Gift::find($request->id);
        $list = $gift->giftList;

        if ($this->listIdIsChosen($list->id)) {
            return 'chosen';
        }

        if ($list->activated) {
            $gift->pick();
            if ($request->has('comment')) {
                $gift->comment($request->comment);
            }
            session()->push('chosen_lists', $list->id);
        }

        return view('gift', compact('gift', 'list'));
    }

    /**
     * Check if the user has already chosen a gift in a current list.
     *
     * @param int $listId
     * @return bool
     */
    private function listIdIsChosen(int $listId)
    {
        if (!session('chosen_lists')) {
            return false;
        }

        $result = in_array($listId, session('chosen_lists'));

        return $result;
    }
}
