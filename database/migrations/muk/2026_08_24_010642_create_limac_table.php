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
        Schema::create('limac', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debitur_id')->constrained('debiturs')->onDelete('cascade');
            
            // 5C Utama
            $table->text('capital')->nullable();
            $table->text('condition')->nullable();
            $table->string('capacity', 300)->nullable();
            $table->text('keluarga')->nullable();
            $table->text('anak')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('internal')->nullable();
            $table->text('eksternal')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limac');
    }
};