<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dossier_id');
            $table->timestamps();
            $table->date('date');
            $table->integer('duree')->nullable();
            $table->mediumText('intervenants')->nullable();
            $table->string('modalite')->nullable();
            $table->string('modalite_autre')->nullable();
            $table->mediumText('destinataires')->nullable();
            $table->mediumText('sujet')->nullable();
            $table->mediumText('commentaires')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
