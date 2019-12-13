<?php

namespace App\Http\Controllers;

use App\Background;
use App\GiftList;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftListController extends Controller
{
    /**
     * Display gift lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $lists = Auth::user()->giftLists;

        return view('lists', compact('lists'));
    }

    /**
     * Show the form for creating a new gift list.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $backgrounds = Background::orderBy('name')->get();

        return view('list_create', compact('backgrounds'));
    }

    /**
     * Get view for current gift list.
     *
     * @param GiftList $giftList
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function giftsIndex(GiftList $giftList)
    {
        $this->authorize('userAllowed', $giftList);

        return view('helpers.gift_list_edit', compact('giftList'));
    }

    /**
     * Get gift list for unauthorized users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function giftsFromSession()
    {
        $giftList = session('created');

        return view('helpers.gift_list_edit', compact('giftList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateForm($request, true);
        $data['user_id'] = Auth::id();

        $newGift = GiftList::create($data);

        return redirect('/lists/'.$newGift->id.'/edit');
    }

    /**
     * Create a list for unauthorized users.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeToSession(Request $request)
    {
        $data = $this->validateForm($request, true);
        $list = session('created');

        $data['gifts'] = $list ? $list->gifts : [];

        session(['created' => (object) $data]);

        return redirect('edit');
    }

    /**
     * Show the form for editing the specified gift list.
     *
     * @param GiftList $giftList
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(GiftList $giftList)
    {
        $this->authorize('userAllowed', $giftList);

        if ($giftList->isOutdated()) {
            abort('404');
        }

        $backgrounds = Background::orderBy('name')->get();

        $price = Setting::getPrice();

        return view('list_settings_edit', compact(
            'giftList',
            'backgrounds',
            'price'
        ));
    }

    /**
     * Edit gifts for the current gift list.
     *
     * @param GiftList $giftList
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function editList(GiftList $giftList)
    {
        $this->authorize('userAllowed', $giftList);
        if ($giftList->isOutdated()) {
            abort('404');
        }

        $price = Setting::getPrice();

        return view('list_edit', compact('giftList', 'price'));
    }

    /**
     * Gifts edit page for unauthorized users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editToSession()
    {
        $giftList = session('created');

        return view('list_edit', compact('giftList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param GiftList $giftList
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, GiftList $giftList)
    {
        $this->authorize('userAllowed', $giftList);

        if ($giftList->isOutdated()) {
            abort('404');
        }

        $data = $this->validateForm($request);

        $giftList->update($data);

        return redirect('/lists/'.$giftList->id.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GiftList $giftList
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(GiftList $giftList)
    {
        $this->authorize('userAllowed', $giftList);

        $giftList->delete();

        return redirect('/lists');
    }

    /**
     * Validate input form data.
     *
     * @param Request $request
     * @param bool $new
     * @return mixed
     */
    private function validateForm(Request $request, bool $new = false)
    {
        $unique = $new ? '|unique:gift_lists,domain' : '';

        $data = $request->validate([
            'domain' => 'required|alpha_dash|max:30'.$unique,
            'title' => 'required|max:100',
            'date' => 'required|date|after:today',
            'background_id' => 'required|numeric',
            'information' => 'max:1000',
            'comment_opt' => 'boolean',
        ]);

        if (!$request->has('comment_opt')) {
            $data['comment_opt'] = false;
        }

        return $data;
    }
}
