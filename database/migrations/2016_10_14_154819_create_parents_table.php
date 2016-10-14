<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('current')->default(true);
            $table->timestamps();
            $table->integer('dossier_id')->unsigned();
            $table->string('prenom');
            $table->string('lien');
            $table->string('lieuT1');
            $table->string('courriel');
            $table->string('tel');
            $table->string('tel2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('parents');
    }
}
