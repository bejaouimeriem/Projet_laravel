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
    Schema::create('sous_chapitres', function (Blueprint $table) {
        $table->id();
        $table->integer('last_page_read')->nullable();
        $table->string('lien_video')->nullable();
        $table->string('pdf')->nullable();
        $table->unsignedBigInteger('chapitre_id')->nullable(); // clé étrangère propre
        $table->unsignedBigInteger('user_id')->nullable();    // correction de l'espace dans user_id
        $table->text('description')->nullable();               // `text` pour contenu potentiellement long
        $table->string('image')->nullable();
        $table->string('title')->nullable();
        $table->unsignedInteger('pourcentage')->nullable();   // pourcentage, utilisé de manière appropriée
        $table->timestamps();

        // Clé étrangère pour chapitre et user (si ces tables existent)
        $table->foreign('chapitre_id')->references('id')->on('chapitres')->onDelete('set null');
        $table->foreign('user_id')->references('id')->on('utilisateurs')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_chapitres');
    }
};
