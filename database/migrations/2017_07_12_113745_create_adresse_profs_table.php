<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdresseProfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresse_profs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('enseignant_id');
            $table->string('no_civique')->nullable();
            $table->string('rue')->nullable();
            $table->string('cp')->nullable();
            $table->string('ville')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adresse_profs');
    }
}
