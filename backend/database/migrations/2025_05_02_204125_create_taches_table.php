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
            $table->string('nomTache');
            $table->integer('done')->default(0);
            $table->date('date');
            $table->foreignId('user_id')->constrained('utilisateurs')->onDelete('cascade'); 
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
