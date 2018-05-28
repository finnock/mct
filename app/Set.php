<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $primaryKey = 'code';

    public $incrementing = false;

    protected $fillable = [
        'code',
        'gathererCode',
        'oldCode',
        'magicCardsInfoCode',
        'name',
        'releaseDate',
        'border',
        'type',
        'block',
        'onlineOnly',
        'cardCount'
    ];

    public $timestamps = false;

    public function cards()
    {
        return $this->hasMany('App\Card', 'setCode', 'code')->orderBy('numberNumeric');
    }


    public static function expansionsAndCoreSets()
    {
        return Set::where('type', 'expansion')
            ->orWhere('type', 'core')
            ->orderBy('releaseDate', 'desc')
            ->get();
    }


    public static function expansions()
    {
        return Set::where('type', 'expansion')
//            ->where('releaseDate', '<=', '2015-01-23')
            ->orderBy('releaseDate', 'desc')
            ->get();
    }

    public static function cores()
    {
        return Set::where('type', 'core')
            ->where('releaseDate', '<=', '2015-01-23')
            ->orderBy('releaseDate', 'desc')
            ->get();
    }

    protected $table = 'sets';
}
