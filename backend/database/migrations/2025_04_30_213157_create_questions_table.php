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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('contenu')->nullable(); // text pour contenu de question potentiellement long
            $table->unsignedBigInteger('test_id')->nullable(); // clé étrangère propre
    
            $table->timestamps();
    
            // Clé étrangère (si la table tests existe)
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
