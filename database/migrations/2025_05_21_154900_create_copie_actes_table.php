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
            $table->string("nom");
            $table->string("prenoms");
            $table->date("date_naissance");
            $table->string("lieu_naissance");

            $table->string("demander_par");
            $table->string("nom_demandeur");
            $table->string("prenom_demandeur");
            $table->string("email_demandeur")->nullable();
            $table->string("contact_demandeur");
            $table->string("adresse_demandeur");
            $table->string("piece_identite_demandeur")->nullable();

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
