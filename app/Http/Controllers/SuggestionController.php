<?php

namespace App\Http\Controllers;

use App\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        if (Gate::allows('admin')) {
            $suggestions = Suggestion::orderBy('gift')->paginate(100);

            return view('admin.suggestions', compact('suggestions'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('admin')) {
            $suggestion = new Suggestion;
            $suggestion->gift = $request->gift;
            $suggestion->gift_ru = $request->gift_ru;
            $suggestion->save();

            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Suggestion $suggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        if (Gate::allows('admin')) {
            $suggestion->gift = $request->gift;
            $suggestion->gift_ru = $request->gift_ru;
            $suggestion->save();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Suggestion $suggestion
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Suggestion $suggestion)
    {
        if (Gate::allows('admin')) {
            $suggestion->delete();
            return back();
        }
    }

    /**
     * Get a random suggestion.
     *
     * @return mixed
     */
    public function random()
    {
        $gift = app()->getLocale() === 'ru' ? 'gift_ru' : 'gift';

        return Suggestion::inRandomOrder()->first()->$gift;
    }
}
