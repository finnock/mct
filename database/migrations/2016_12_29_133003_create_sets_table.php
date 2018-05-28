<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->string('code')->unique();
            $table->primary('code', 10);

            $table->string('gathererCode')->nullable();
            $table->string('oldCode')->nullable();
            $table->string('magicCardsInfoCode')->nullable();

            $table->string('name')->nullable();
            $table->string('releaseDate')->nullable();
            $table->string('border')->nullable();
            $table->string('type')->nullable();
            $table->string('block')->nullable();
            $table->string('onlineOnly')->nullable();
            $table->integer('cardCount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sets');
    }
}
