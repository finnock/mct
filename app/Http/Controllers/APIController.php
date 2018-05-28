<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Card;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function indexCollection(){
        $cards = Auth::user()->cards()->orderBy('created_at', 'desc')->get();
        $vueCards = Card::cardListToVueModel($cards);

        return $vueCards;
    }
}