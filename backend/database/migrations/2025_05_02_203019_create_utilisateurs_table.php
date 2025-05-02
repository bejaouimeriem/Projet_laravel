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

            $table->unsignedBigInteger('personnalite_id')->nullable();
            $table->unsignedBigInteger('quote_id')->nullable();

            $table->timestamps();

            $table->foreign('personnalite_id')->references('id')->on('personnalites')->onDelete('set null');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('set null');
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
