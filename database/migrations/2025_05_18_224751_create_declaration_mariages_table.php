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
        Schema::create('declaration_mariages', function (Blueprint $table) {
            $table->id();
            $table->string("numero_declaration");
            $table->string("etat");//enregistrer,en_traitement,disponible
            $table->boolean("paye")->default(0);
            $table->string("type_declaration");
            $table->date("date_declaration");
            $table->integer("montant_declaration")->nullable();
            $table->date("date_payement")->nullable();

            $table->date("date_mariage");
            $table->string("lieu_mariage");
            $table->string("regime_matrimonial");
            $table->string("officier_etat_civil");

            $table->string("nom_epoux");
            $table->string("prenoms_epoux");
            $table->date("date_naissance_epoux");
            $table->string("lieu_naissance_epoux");
            $table->string("nationalite_epoux");
            $table->string("profession_epoux")->nullable();
            $table->string("adresse_epoux");

            $table->string("nom_epouse");
            $table->string("prenoms_epouse");
            $table->date("date_naissance_epouse");
            $table->string("lieu_naissance_epouse");
            $table->string("nationalite_epouse");
            $table->string("profession_epouse")->nullable();
            $table->string("adresse_epouse");

            $table->string("nom_complet_temoins_1");
            $table->string("contact_temoins_1");
            $table->string("nom_complet_temoins_2");
            $table->string("contact_temoins_2");

            $table->string("piece_identite_epoux");
            $table->string("piece_identite_epouse");
            $table->string("acte_naissance_epoux");
            $table->string("acte_naissance_epouse");
            $table->string("certificats_celibat_ou_coutume");
            $table->string("contrat_mariage ")->nullable();
            
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
        Schema::dropIfExists('declaration_mariages');
    }
};
