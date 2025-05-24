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
        Schema::create('traitements', function (Blueprint $table) {
            $table->id();
            $table->foreignId("declaration_naissance_id")->nullable();
            $table->foreignId("declaration_mariage_id")->nullable();
            $table->foreignId("declaration_deces_id")->nullable();
            $table->foreignId("legalisation_id")->nullable();
            $table->foreignId("copie_acte_id")->nullable();

            $table->string("etat");
            $table->date("date_traitement")->nullable();
            $table->date("date_disponible")->nullable();

            $table->foreign('declaration_naissance_id')->references('id')->on('declarations_naissances')->onDelete('cascade');
            $table->foreign('declaration_mariage_id')->references('id')->on('declaration_mariages')->onDelete('cascade');
            $table->foreign('declaration_deces_id')->references('id')->on('declaration_deces')->onDelete('cascade');
            $table->foreign('legalisation_id')->references('id')->on('legalisations')->onDelete('cascade');
            $table->foreign('copie_acte_id')->references('id')->on('copie_actes')->onDelete('cascade');

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
        Schema::dropIfExists('traitements');
    }
};
