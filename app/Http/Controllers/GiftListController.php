<?php

namespace App\Http\Controllers;

use App\Background;
use App\Gift;
use App\GiftList;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftListController extends Controller
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
     * Display gift lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * Show the form for editing the specified gift list.
     *
     * @param GiftList $giftList
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(GiftList $giftList)
    {
        $this->authorize('userAllowed', $giftList);
        $this->authorize('isNotOutdated', $giftList);

        $backgrounds = Background::orderBy('name')->get();

        $price = Setting::getPrice();

        return view('list_edit', compact(
            'giftList',
            'backgrounds',
            'price'
        ));
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
        $this->authorize('isNotOutdated', $giftList);

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
