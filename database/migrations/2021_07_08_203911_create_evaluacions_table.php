<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->date("fecreg_eval");
            $table->integer("nota_deteva");

            $table->unsignedBigInteger("alumno_id");
            $table->unsignedBigInteger('actividad_id');
 
            $table->foreign("alumno_id")
            ->references("id")->on("alumnos");
            
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
        Schema::dropIfExists('evaluacions');
    }
}
