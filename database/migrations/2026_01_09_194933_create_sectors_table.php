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
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
        
            // Translatable
            $table->json('title');
            $table->json('description');
            $table->json('badge_text');
        
            // Visual (one of them)
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
        
            // Colors
            $table->string('gradient_from');
            $table->string('gradient_to');
        
            // Market
            $table->unsignedInteger('market_value');   // 85 (B)
            $table->unsignedInteger('market_percent'); // 85 %
        
            // Control
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};
