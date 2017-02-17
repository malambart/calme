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
            $table->boolean('repondant')->default(false);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('dossier_id')->unsigned();
            $table->string('prenom');
            $table->string('nom');
            $table->string('lien');
            $table->string('lien_autre')->nullable();
            $table->string('lieuT1')->nullable();
            $table->string('courriel')->nullable();
            $table->string('tel')->nullable();
            $table->string('ext')->nullable();
            $table->string('tel2')->nullable();
            $table->string('ext2')->nullable();
            $table->integer('age')->nullable();
            $table->string('scolarite')->nullable();
            $table->string('emploi')->nullable();
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
        Schema::drop('parents');
    }
}
