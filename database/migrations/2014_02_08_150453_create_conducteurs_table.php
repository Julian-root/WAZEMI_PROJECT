<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConducteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->id();
            $table->string('pieceIdentite');
            $table->string('numeroPieceIdentite');
            $table->string('typePermis');
            $table->string('numeroPermis');
            $table->string('plaqueImmatriculation');
            $table->string('lat')->default(7.1606400831706125);
            $table->string('Ing')->default(2.020855702573403);
            // $table->string('estDisponible')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conducteurs');
    }
}
