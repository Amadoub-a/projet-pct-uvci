<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('declaration_deces', function (Blueprint $table) {
            $table->id();
            $table->string("numero_declaration");
            $table->string("etat");//enregistrer,en_traitement,disponible
            $table->boolean("paye")->default(0);
            $table->string("type_declaration");
            $table->date("date_declaration");
            $table->integer("montant_declaration")->nullable();
            $table->date("date_payement")->nullable();

            $table->date("date_deces");
            $table->time("heure_deces");
            $table->string("lieu_deces");
            $table->string("etablissement_deces")->nullable();
            $table->string("cause_deces");

            $table->string("nom_defunt");
            $table->string("prenoms_defunt");
            $table->date("date_naissance_defunt");
            $table->string("lieu_naissance_defunt");
            $table->string("nationalite_defunt");
            $table->string("sexe_defunt");
            $table->string("profession_defunt")->nullable();
            $table->string("situation_familiale_defunt");
            $table->string("adresse_defunt");

            $table->string("nom_declarant");
            $table->string("prenoms_declarant");
            $table->string("lien_parente");
            $table->string("contact_declarant");
            $table->string("adresse_declarant");

            $table->string("certificat_deces");
            $table->string("piece_identite_defunt");
            $table->string("acte_naissance_defunt");
            $table->string("piece_identite_declarant");
            
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaration_deces');
    }
};
