<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parents', function (Blueprint $table) {
            $table->date('date_naiss')->nullable();
            $table->string('situation_familiale')->nullable();
            $table->string('situation_familiale_autre')->nullable();
            $table->string('prenom')->nullable()->change();
            $table->string('nom')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parents', function (Blueprint $table) {
            $table->dropColumn('date_naiss');
            $table->dropColumn('situation_familiale');
            $table->dropColumn('situation_familiale_autre');
        });
    }
}
