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
        Schema::create('workshop_events', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable(); // Date et heure de l'événement
            $table->text('description')->nullable(); // Description, utilise 'text' pour un contenu plus long
            $table->string('image')->nullable(); // Image (URL ou nom de fichier)
            $table->string('lien')->nullable(); // Lien vers un site externe ou une page d'événement
            $table->string('nom')->nullable(); // Nom de l'événement
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshop_events');
    }
};
