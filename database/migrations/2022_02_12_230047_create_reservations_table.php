<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conducteur_id')->unsigned()->nullable();
            $table->string('transport');
            $table->string('conducteur');
            $table->string('client');
            $table->string('plaque');
            $table->bigInteger('client_id')->unsigned();
            $table->string('latTo');
            $table->string('IngTo');
            $table->string('latFrom');
            $table->string('IngFrom');
            $table->string('prix');
            $table->dateTime('dateDepart');
            $table->dateTime('dateArrivee');
            $table->string('note')->default(0);
            $table->string('distance');
            $table->string('status')->default('enCours');
            $table->string('course_end')->default(0);
            $table->string('client_course_end')->default(0);
            $table->string('driver_course_end')->default(0);
            $table->foreign('conducteur_id')->references('id')->on('conducteurs')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
