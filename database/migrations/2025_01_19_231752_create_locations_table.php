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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained()->unique();
            $table->float('centerLng')->nullable();
            $table->float('centerLat')->nullable();
            $table->float('minLng')->nullable();
            $table->float('minLat')->nullable();
            $table->float('maxLng')->nullable();
            $table->float('maxLat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
