<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->char("sexe");
            $table->integer("age");
            $table->foreignId("niveau_scolaire_id")->constrained();
            $table->string("photo")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(function(Blueprint $table){
            $table->dropConstrainedForeignId("niveau_scolaire_id");
        });
        Schema::dropIfExists('etudiants');
    }
};
