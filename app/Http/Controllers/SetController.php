<?php

namespace App\Http\Controllers;


use App\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Card;


class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cores = Set::cores();
        $expansions = Set::expansions();

        return view('sets.index')->with(compact('cores', 'expansions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $set = Set::with('cards.users')->find($code);

        return view('sets.show')->with(compact('set'));
    }

    public function formatArena()
    {
        $apiSrc = route('api.format.arena');

        return view('user.collection')->with(compact('apiSrc'));
    }
}
