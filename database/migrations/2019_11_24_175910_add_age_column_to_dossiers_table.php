<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeColumnToDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossiers', function (Blueprint $table) {
            $table->float('age')->nullable();
            $table->string('langue')->nullable();
            $table->date('date_naiss')->nullable()->change();
            $table->string('prenom')->nullable()->change();
            $table->string('nom')->nullable()->change();
            $table->string('nom_complet')->nullable()->change();
            $table->string('no_doss_chus')->nullable()->change();
            $table->string('diagnostic')->nullable();
            $table->tinyInteger('accepte')->nullable();
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
            $table->dropColumn('age');
            $table->dropColumn('langue');
            $table->dropColumn('accepte');
            $table->dropColumn('diagnostic');
        });
    }
}
