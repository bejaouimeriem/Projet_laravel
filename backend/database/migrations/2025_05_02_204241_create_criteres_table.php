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
            $table->string('nom');
            $table->text('contenu');
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('personnalite_id');
            $table->timestamps();

            $table->foreign('personnalite_id')
                  ->references('id')->on('personnalites')
                  ->onDelete('cascade');
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
