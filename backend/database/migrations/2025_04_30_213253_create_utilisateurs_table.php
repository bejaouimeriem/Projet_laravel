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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('role')->nullable(); // Utilisation de unsignedTinyInteger pour les rôles (valeurs limitées)
            $table->unsignedBigInteger('personnalite_id')->nullable(); // Correction de l'espace dans 'personnalite_id'
            $table->unsignedBigInteger('quote_id')->nullable(); // Correction de l'espace dans 'quote_id'
            $table->dateTime('token_expiry')->nullable(); // Expiration du token
            $table->string('access_token')->nullable(); // Token d'accès
            $table->string('email')->nullable()->unique(); // Email unique pour l'utilisateur
            $table->string('mdps_compte')->nullable(); // Mot de passe du compte
            $table->string('mdps_super_admin')->nullable(); // Mot de passe super admin
            $table->string('nom')->nullable(); // Nom de l'utilisateur
            $table->string('reset_token')->nullable(); // Token de réinitialisation du mot de passe
            $table->timestamps();
    
            // Clés étrangères (si les tables 'personnalites' et 'quotes' existent)
            $table->foreign('personnalite_id')->references('id')->on('personnalites')->onDelete('set null');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
