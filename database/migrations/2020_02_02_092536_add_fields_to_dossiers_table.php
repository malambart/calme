<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossiers', function (Blueprint $table) {
            $table->integer('orientation')->nullable();
            $table->string('orientation_autre')->nullable();
            $table->string('pourquoi_la_recherche_n_est_pas_proposee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('dossiers', function (Blueprint $table) {
            $table->dropColumn('orientation');
            $table->dropColumn('orientation_autre');
            $table->dropColumn('pourquoi_la_recherche_n_est_pas_proposee');
        });
    }
}
