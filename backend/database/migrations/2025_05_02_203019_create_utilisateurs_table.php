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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('email')->unique();
            $table->string('mdpsCompte');
            $table->integer('role')->default(0);
            $table->string('resetToken')->nullable();
            $table->dateTime('tokenExpiry')->nullable();
            $table->string('accessToken')->nullable();
            $table->foreignId('personnalite_id')->constrained('personnalites')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
