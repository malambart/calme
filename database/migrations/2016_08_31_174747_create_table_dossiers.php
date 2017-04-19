<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTableDossiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('nom')->index();
            $table->string('prenom')->index();
            $table->string('nom_complet');
            $table->string('no_doss_chus')->unique()->index();
            $table->date('date_naiss');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('sexe');
            $table->boolean('exclu')->nullable();
        });
        DB::statement('ALTER TABLE dossiers ADD FULLTEXT recherche (prenom, nom, no_doss_chus);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dossiers');
    }
}
