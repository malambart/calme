<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('dossier_id')->unsigned();
            $table->string('famille')->nullable();
            $table->integer('nb_enfants')->nullable();
            $table->string('responsable')->nullable();
            $table->string('modalite_garde')->nullable();
            $table->string('langue')->nullable();
            $table->date('date_eval')->nullable();
            $table->string('pedopsy')->nullable();
            $table->string('diagnostics')->nullable();
            $table->string('autres')->nullable();
            $table->string('medication')->nullable();
            $table->date('reference')->nullable();
            $table->string('motif')->nullable();
            $table->boolean('ante_bilan')->nullable();
            $table->date('ante_bilan_date')->nullable();
            $table->string('ante_bilan_resultat')->nullable();
            $table->boolean('plan_intervention_scolaire')->nullable();
            $table->boolean('lie_anxiete')->nullable();
            $table->string('lie_anxiete_d')->nullable();
            $table->string('facteurs_predisposants')->nullable();
            $table->string('facteurs_precipitants')->nullable();
            $table->string('cognitions')->nullable();
            $table->string('sensations_physiques')->nullable();
            $table->string('comportements')->nullable();
            $table->string('rassurance')->nullable();
            $table->boolean('imp_maison')->nullable();
            $table->boolean('imp_ecole')->nullable();
            $table->boolean('imp_loisirs')->nullable();
            $table->boolean('imp_reseau_social')->nullable();
            $table->string('impacts_d')->nullable();
            $table->string('attentes_jeune')->nullable();
            $table->string('attentes_parents')->nullable();
            $table->string('impressions_autres')->nullable();
            $table->string('retenu')->nullable();
            $table->string('non_retenu_motifs')->nullable();
            $table->string('non_retenu_redirige')->nullable();
            $table->string('suivi')->nullable();
            $table->string('type_suivi')->nullable();
            $table->string('suivi_duree')->nullable();
            $table->string('suivi_frequence')->nullable();
            $table->string('recommendations')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
