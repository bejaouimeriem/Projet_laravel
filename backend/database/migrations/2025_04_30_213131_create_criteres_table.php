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
        Schema::create('criteres', function (Blueprint $table) {
            $table->id();
            $table->string('contenu')->nullable();
            $table->string('nom')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
    
            // Clé étrangère si la table personnalites existe
            $table->foreign('personnalite_id')->references('id')->on('personnalites')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteres');
    }
};
