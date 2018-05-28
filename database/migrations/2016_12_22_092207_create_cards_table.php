<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {

            // Identifiers
            $table->string('id')->unique(); // SHA1(setCode, cardName, cardImageName)
            $table->string('setCode', 10)->nullable();
            $table->string('name')->nullable();
            $table->string('number', 5)->nullable();
            $table->integer('numberNumeric')->nullable();
            $table->string('multiverseID')->nullable();
            $table->string('imageName')->nullable();
            $table->string('mciNumber')->nullable();

            /* JSON -Fields:
             * layout, names, colors, colorIdentity, supertypes, types,
             * subtypes, variations, hand, life, reserved, releaseDate, starter,
             * loyalty, watermark, border, rulings, printings, legalities
             *
             * Type: string, needs to be typecast in Laravel
             */
            $table->longText('meta');


            // Card Values
            $table->string('layout')->nullable();
            $table->string('manaCost')->nullable();
            $table->string('convertedManaCost')->nullable();
            $table->string('type')->nullable();
            $table->string('rarity')->nullable();
            $table->longText('text')->nullable();
            $table->longText('flavor')->nullable();
            $table->string('artist')->nullable();
            $table->string('power')->nullable();
            $table->string('toughness')->nullable();
            $table->string('timeshifted')->nullable();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
