<?php

namespace App\Http\Controllers;

use App\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestions = Suggestion::orderBy('gift')->paginate(100);

        return view('admin.suggestions', compact('suggestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suggestion = new Suggestion;
        $suggestion->gift = $request->gift;
        $suggestion->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function show(Suggestion $suggestion)
    {
        return $suggestion->gift;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(Suggestion $suggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suggestion  $suggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        $suggestion->gift = $request->gift;
        $suggestion->save();
        return back();
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
        $suggestion->delete();
        return back();
    }

    /**
     * Get a random suggestion.
     *
     * @return mixed
     */
    public function random()
    {
        return Suggestion::inRandomOrder()->first()->gift;
    }
}
