<?php


namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($code, $number)
    {
        $card = Card::where('setCode', $code)
            ->where('number', $number)
            ->get()
            ->first();

        return view('cards.show')
            ->with(['card' => $card]);

    }


    /**
     * Return the image coresponding to the given card
     *
     * @param  string $code
     * @param  string $number
     * @return \Illuminate\Http\Response
     */
    public function image($code, $number)
    {
        $card = Card::where('setCode', $code)
            ->where('number', $number)
            ->get()
            ->first();

        return response()
            ->file(storage_path("/app/card-images/$code/$card->imageName.jpg"));
    }

    public function imageLandscape($code, $number)
    {
        return Card::where('setCode', $code)
            ->where('number', $number)
            ->get()
            ->first()
            ->imageLandscape()
            ->response('jpg');

    }
}
