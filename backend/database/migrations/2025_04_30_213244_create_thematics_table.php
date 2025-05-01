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
        Schema::create('thematics', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // URL ou nom du fichier de l'image
            $table->string('nom')->nullable();   // Nom de la thématique
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thematics');
    }
};
