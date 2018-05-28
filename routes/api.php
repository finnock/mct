<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ajax/collection', function (Request $request) {
    $cards = Auth::user()->cards()->get();
    $cardList = array();

    foreach ($cards as $card){
        $cardItem = new stdClass;
        $cardItem->manaCost = $card->manaCost;
        $cardItem->convertedManaCost = $card->convertedManaCost;
        $cardItem->type = $card->type;
        $cardItem->meta = json_decode($card->meta);
        $cardItem->imageName = $card->imageName;
        $cardItem->name = $card->name;
        $cardItem->power = $card->power;
        $cardItem->rarity = $card->rarity;
        $cardItem->text = ($card->text ?: '');
        $cardItem->toughness = $card->toughness;
        $cardItem->count = $card->pivot->count;
        $cardItem->imagePath = $card->imagePath();

        $cardItem->cmcSort = ($card->convertedManaCost ?: 0);

        $cardItem->number = $card->numberNumeric;
        $cardItem->code = $card->setCode;
        $cardItem->id = $card->id;

        array_push($cardList, $cardItem);
    }

    return $cardList;
});
