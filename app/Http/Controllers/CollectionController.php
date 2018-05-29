<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Card;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{

    public function index()
    {
        $cards = Card::cardListToVueModel(Auth::user()->cards()->orderBy('created_at', 'desc')->get());
        $count = true;

        return view('user.collection')->with(compact('cards', 'count'));
    }


    public function add()
    {
        $cards = Auth::user()->cards()->orderBy('updated_at', 'desc')->take(5)->get();
        $count = true;

        return view('user.collectionAdd')->with(compact('cards', 'count', 'card'));
    }

    public function addBatch()
    {
        return view('user.collectionAddBatch');
    }

    private function mtgaExportDecode($export)
    {
        // MTGArena decided to make the expansion code for Dominaria "DAR" instead of "DOM"
        $export = str_replace('(DAR)', '(DOM)', $export);

        $decodingExpression = '/(\d+) (.+) \(([A-Z]{3})\) (\d+)/m';
        /* Decoding the export syntax given by MTGArena
         * Group 1: Card Count
         *       2: Card Name
         *       3: Expansion Code
         *       4: Card Number
         */

        preg_match_all($decodingExpression, $export, $matches, PREG_SET_ORDER, 0);
        return $matches;
    }

    private function addCardToCollection($setCode, $cardNumber, $cardCount)
    {
        // Fetch the Card Object from the DB with the given set/number
        $card = \App\Card::where('setCode', $setCode)
            ->where('number', $cardNumber)
            ->first();

        if($card == null)
        {
            dd("$setCode $cardNumber");
        }

        // Check if the already has the Card in Collection
        if(Auth::user()->cards()->get()->contains($card->id))
        {
            // Yes: Increase the stored amount by the given value
            $preCount = Auth::user()->cards()->find($card->id)->pivot->count;
            Auth::user()->cards()->updateExistingPivot($card->id, ['count' => $preCount + $cardCount]);
        }else{
            // No: Setup a new record with the given value
            Auth::user()->cards()->attach($card->id, ['count' => $cardCount]);
        }
    }

    public function store(Request $request)
    {
        if($request->all()['type'] == 'batch')
        {
            if($request->all()['submit'] == 'reset')
                Auth::user()->resetCollection();

            $cardBatch = $this->mtgaExportDecode($request->all()['cardBatch']);
            foreach ($cardBatch as $cardMatch)
            {
                // Add the card to the Collection
                $this->addCardToCollection(
                    $cardMatch[3], // SetCode
                    $cardMatch[4], // CardNumber
                    $cardMatch[1]  // CardCount
                );
            }

            return redirect()->route('collection.index');
        }

        if(isset($request->all()['cardID'])){
            Auth::user()->cards()->attach($request->all()['cardID']);

            return back()->withInput();
        }

        if($request->all()['type'] == 'add')
        {
            // Split the given Cardnumber/Count
            $cardNumberSplit = explode(',', $request->all()['cardNumber']);

            // Add the card to the Collection
            $this->addCardToCollection(
                $request->all()['setCode'],
                $cardNumberSplit[0],
                (isset($cardNumberSplit[1])) ? $cardNumberSplit[1] : 1
            );

            // Send the User back to the previous form
            return back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $oldCount = Auth::user()->cards()->find($id)->pivot->count;
        Auth::user()->cards()->updateExistingPivot($id, ['count' => ($oldCount + $request->all()['count'])]);

        return back();
    }

    public function delete($id)
    {
        Auth::user()->cards()->detach($id);

        return back();
    }

    function dashboard()
    {
        $cards = Auth::user()->cards()->get();
        $cardCount = 0;

        foreach ($cards as $card)
        {
            $cardCount += $card->pivot->count;
        }

        return view('dashboard')->with(compact('cardCount'));
    }
}
