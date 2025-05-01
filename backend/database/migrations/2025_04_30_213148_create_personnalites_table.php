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
        Schema::create('personnalites', function (Blueprint $table) {
            $table->id();
            $table->text('contenu')->nullable();       // `text` est mieux pour des contenus longs
            $table->string('icon')->nullable();        // icône, format court → `string` OK
            $table->string('image')->nullable();       // image (ex: nom de fichier ou URL)
            $table->string('nom')->nullable();         // nom en français
            $table->string('nom_english')->nullable(); // nom en anglais
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnalites');
    }
};
