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
            $table->string('lieuT1');
            $table->string('courriel');
            $table->string('tel');
            $table->string('ext')->nullable();
            $table->string('tel2')->nullable();
            $table->string('ext2')->nullable();
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
