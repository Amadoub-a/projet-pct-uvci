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
        Schema::create('certificat_vies', function (Blueprint $table) {
            $table->id();
            $table->string("numero_declaration");
            $table->string("etat");//enregistrer,en_traitement,disponible
            $table->boolean("paye")->default(0);
            $table->string("type_declaration");
            $table->date("date_declaration");
            $table->integer("montant_declaration")->nullable();
            $table->date("date_payement")->nullable();

            $table->string("nom_personne");
            $table->string("prenoms_personne");
            $table->date("date_naissance_personne");
            $table->string("lieu_naissance_personne");
            $table->string("nationalite_personne");
            $table->string("profession_personne")->nullable();
            $table->string("contact_personne");
            $table->string("email_personne")->nullable();
            $table->string("adresse_personne");

            $table->string("type_document");
            $table->string("autres")->nullable();
            $table->date("date_document");
            $table->string("autorite");
            $table->text("motif");
            $table->integer("nb_copies");

            $table->string("document_original");
            $table->string("piece_demandeur");
            $table->string("justificatif_domicile");

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
        Schema::dropIfExists('certificat_vies');
    }
};
