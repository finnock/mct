<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class Card extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'layout',
        'setCode',
        'name',
        'number',
        'numberNumeric',
        'multiverseID',
        'imageName',
        'mciNumber',
        'meta',
        'manaCost',
        'convertedManaCost',
        'type',
        'rarity',
        'text',
        'flavor',
        'artist',
        'power',
        'toughness',
        'timeshifted'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public $timestamps = false;

    public function set()
    {
        return $this->belongsTo('App\Set', 'setCode', 'code');
    }

//    public function meta()
//    {
//        return json_decode($this->meta, true);
//    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('count');
    }

    public function imagePath()
    {
        $code = ($this->setCode == 'CON') ? 'CFX' : $this->setCode;
        return "/img/card-img/$code/$this->imageName.jpg";
//        return route('cardImage', ['code' => $code, 'number' => $this->number]);
    }

    public function imagePathBar()
    {
        $code = ($this->setCode == 'CON') ? 'CFX' : $this->setCode;
        return "/img/card-img/$code/$this->imageName"."_bar.jpg";
//        return route('cardImage', ['code' => $code, 'number' => $this->number]);
    }

    public function imagePathLandscape()
    {
        $code = ($this->setCode == 'CON') ? 'CFX' : $this->setCode;
        return route('card.image-landscape', ['code' => $code, 'number' => $this->number]);
    }

    public function imageLandscape()
    {
        $code = ($this->setCode == 'CON') ? 'CFX' : $this->setCode;
        $img = Image::make(storage_path("/app/card-images/$code/$this->imageName.jpg"))->rotate(-90);

        return $img;
    }

//    public function getMetaAttribute($value){
//        return json_decode(json_decode($value));
//    }

    public function vueItem()
    {
        $cardItem = new \stdClass;
        $cardItem->manaCost             = $this->manaCost;
        $cardItem->convertedManaCost    = $this->convertedManaCost;
        $cardItem->type                 = $this->type;
        $cardItem->meta                 = $this->meta;
        $cardItem->imageName            = $this->imageName;
        $cardItem->name                 = $this->name;
        $cardItem->power                = $this->power;
        $cardItem->rarity               = $this->rarity;
        $cardItem->text                 = ($this->text ?: '');
        $cardItem->toughness            = $this->toughness;
        $cardItem->imagePath            = $this->imagePath();
        $cardItem->imagePathBar         = $this->imagePathBar();
        $cardItem->directLink           = route('showCard', [
                                              'code' => $this->setCode,
                                              'number' => $this->number
                                          ]);

        $cardItem->textP                = explode("\n", $this->text);
        foreach ($cardItem->textP as $key => $text)
            $cardItem->textP[$key] =  preg_replace("/(.*) \((.*)\)/", "$1 <i>($2)</i>", $text);

        $cardItem->count = 0;
        foreach ($this->users as $user)
            if ($user->id == Auth::id())
                $cardItem->count = $user->pivot->count;

        $cardItem->mciNumber            = $this->mciNumber;
        $cardItem->cmcSort              = ($this->convertedManaCost ?: 0);
        $cardItem->number               = $this->numberNumeric;
        $cardItem->code                 = $this->setCode;
        $cardItem->id                   = $this->id;

        return $cardItem;
    }



    public static function backImagePath()
    {
        return '/img/card-img/cardback.jpg';
    }

    public function mciPath()
    {
        return "https://magiccards.info/scans/en/" . strtolower($this->setCode)."/".(($this->mciNumber) ?? ($this->number)).".jpg";
    }

    public static function cardListToVueModel($cards)
    {
        $cardList = array();

        foreach ($cards as $card){
            array_push($cardList, $card->vueItem());
        }

        return json_encode($cardList);
    }
}
