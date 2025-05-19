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
        Schema::create('payements', function (Blueprint $table) {
            $table->id();
            $table->integer('prestation_id');
            $table->string('type_prestation');

            $table->string('reference')->unique(); // Référence interne
            $table->string('provider')->nullable(); // Exemple : 'orange_money', 'cinetpay'
            $table->string('transaction_id')->nullable(); // ID API externe
            $table->string('status')->default('pending'); // Statut : pending, success, failed
            $table->decimal('montant', 10, 2); // Montant avec décimales

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('callback_payload')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->dateTime('deleted_at')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('created_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payements');
    }
};
