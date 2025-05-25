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
        Schema::create('declarations_naissances', function (Blueprint $table) {
            $table->id();
            $table->string("numero_declaration");
            $table->string("etat");
            $table->boolean("paye")->default(0);
            $table->string("type_declaration");
            $table->date("date_declaration");
            $table->integer("montant_declaration")->nullable();
            $table->date("date_payement")->nullable();

            $table->string("nom_enfant");
            $table->string("prenoms_enfant");
            $table->date("date_naissance_enfant");
            $table->time("heure_naissance_enfant");
            $table->foreignId("lieu_naissance_enfant");
            $table->string("etablissement_naissance_enfant");
            $table->string("nationalite_enfant");
            $table->string("sexe_enfant");

            $table->string("nom_pere")->nullable();
            $table->string("prenoms_pere")->nullable();
            $table->date("date_naissance_pere")->nullable();
            $table->string("lieu_naissance_pere")->nullable();
            $table->string("nationalite_pere")->nullable();
            $table->string("profession_pere")->nullable();
            $table->string("adresse_pere")->nullable();

            $table->string("nom_mere")->nullable();
            $table->string("prenoms_mere")->nullable();
            $table->date("date_naissance_mere")->nullable();
            $table->string("lieu_naissance_mere")->nullable();
            $table->string("nationalite_mere")->nullable();
            $table->string("profession_mere")->nullable();
            $table->string("adresse_mere")->nullable();

            $table->string("declarant");
            $table->string("nom_declarant")->nullable();
            $table->string("prenoms_declarant")->nullable();
            $table->string("lien_avec_enfant")->nullable();
            $table->string("contact_declarant")->nullable();

            $table->string("certificat_naissance");
            $table->string("piece_identite_pere");
            $table->string("piece_identite_mere");
            $table->string("piece_identite_declarant")->nullable();

            $table->foreign('lieu_naissance_enfant')->references('id')->on('communes')->onDelete('cascade');

            $table->string("numero_extrait")->nullable();
            $table->date("date_registre")->nullable();
            $table->date("date_delivrance")->nullable();
            $table->integer("lieu_delivrance")->nullable();
            $table->string("signature")->nullable();

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
        Schema::dropIfExists('declarations');
    }
};
