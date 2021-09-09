<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalactisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalactis', function (Blueprint $table) {
            $table->id();

            $table->string("descrip_detac");
            $table->integer("poreva_detac");

            $table->unsignedBigInteger("actividad_id");

            $table->foreign("actividad_id")
            ->references("id")->on("actividads");

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
        Schema::dropIfExists('detalactis');
    }
}
