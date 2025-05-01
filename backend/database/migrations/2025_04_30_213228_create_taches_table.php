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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(); // Date de la tâche
            $table->boolean('done')->default(false); // 'done' comme booléen pour vrai/faux
            $table->string('nom_tache')->nullable(); // Nom de la tâche
            $table->unsignedBigInteger('user_id')->nullable(); // Clé étrangère propre pour 'user_id'
            $table->timestamps();
    
            // Clé étrangère pour user_id (si la table utilisateurs existe)
            $table->foreign('user_id')->references('id')->on('utilisateurs')->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
