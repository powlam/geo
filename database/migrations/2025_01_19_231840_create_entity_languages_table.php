<?php

declare(strict_types=1);

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
        Schema::create('entity_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->timestamps();

            $table->unique(['entity_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_languages');
    }
};
