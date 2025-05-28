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
        Schema::create('copie_actes', function (Blueprint $table) {
            $table->id();
            $table->string("numero_declaration");
            $table->string("etat");//enregistrer,en_traitement,disponible
            $table->boolean("paye")->default(0);
            $table->string("type_declaration");
            $table->date("date_declaration");
            $table->integer("montant_declaration")->nullable();
            $table->date("date_payement")->nullable();

            $table->string("type_acte");
            $table->string("type_copie");
            $table->string("numero_acte");

            //naissance
            $table->string("nom_enfant")->nullable();
            $table->string("prenoms_enfant")->nullable();
            $table->date("date_naissance_enfant")->nullable();
            $table->foreignId("lieu_naissance")->nullable();

            //deces
            $table->string("nom_defunt")->nullable();
            $table->string("prenoms_defunt")->nullable();
            $table->date("date_deces")->nullable();
            $table->foreignId("lieu_deces")->nullable();

            //mariage
            $table->string("nom_complet_epoux")->nullable();
            $table->string("nom_complet_epouse")->nullable();
            $table->date("date_mariage")->nullable();
            $table->foreignId("lieu_mariage")->nullable();

            $table->string("demander_par");
            $table->string("nom_demandeur")->nullable();
            $table->string("prenom_demandeur")->nullable();
            $table->string("email_demandeur")->nullable();
            $table->string("contact_demandeur")->nullable();
            $table->string("adresse_demandeur")->nullable();

            $table->string("piece_identite_demandeur")->nullable();
            $table->string("justificatif_lien")->nullable();
            $table->string("procuration")->nullable();

            $table->date("date_delivrance")->nullable();
            $table->string("signature")->nullable();

            $table->foreignId("naissance_id")->nullable();
            $table->foreignId("deces_id")->nullable();
            $table->foreignId("mariage_id")->nullable();

            $table->foreign('lieu_naissance')->references('id')->on('communes')->onDelete('cascade');
            $table->foreign('lieu_deces')->references('id')->on('communes')->onDelete('cascade');
            $table->foreign('lieu_mariage')->references('id')->on('communes')->onDelete('cascade');
            
            $table->foreign('naissance_id')->references('id')->on('declarations_naissances')->onDelete('cascade');
            $table->foreign('deces_id')->references('id')->on('declaration_deces')->onDelete('cascade');
            $table->foreign('mariage_id')->references('id')->on('declaration_mariages')->onDelete('cascade');

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
        Schema::dropIfExists('copie_actes');
    }
};
