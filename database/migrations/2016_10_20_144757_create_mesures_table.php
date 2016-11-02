<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesures', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('temps')->unsigned();
            $table->integer('dossier_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->integer('ecole_id')->nullable();
            $table->string('prenom_ens')->nullable();
            $table->string('nom_ens')->nullable();
            $table->string('tel_ens')->nullable();
            $table->string('courriel_ens')->nullable();
            $table->string('fax_ens')->nullable();
            $table->foreign('dossier_id')
                ->references('id')
                ->on('dossiers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mesures');
    }
}
