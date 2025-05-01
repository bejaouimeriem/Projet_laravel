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
        Schema::create('chapitres', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable(); // pour du texte potentiellement long
            $table->string('image')->nullable(); // chemin ou nom de fichier
            $table->unsignedBigInteger('thematic_id')->nullable(); // correction : suppression de l’espace inutile
            $table->string('title')->nullable();
            $table->unsignedInteger('pourcentage')->nullable(); // pour éviter les valeurs négatives
            $table->timestamps();
    
            // Clé étrangère optionnelle si la table 'thematiques' existe :
            $table->foreign('thematic_id')->references('id')->on('thematiques')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapitres');
    }
};
