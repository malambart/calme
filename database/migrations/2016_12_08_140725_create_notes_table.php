<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('no_seance');
            $table->date('date')->nullable();
            $table->string('presence')->nullable();
            $table->integer('ponctualite')->nullable();
            $table->string('ponctualite_motif')->nullable();
            $table->string('comportement')->nullable();
            $table->string('comportement_autre')->nullable();
            $table->mediumText('contenu')->nullable();
            $table->mediumText('commentaires')->nullable();
            $table->date('prochaine_rencontre)')->nullanle();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
