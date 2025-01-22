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
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contained_id')->constrained(
                table: 'entities', indexName: 'relations_contained_id'
            );
            $table->foreignId('container_id')->constrained(
                table: 'entities', indexName: 'relations_container_id'
            );
            $table->string('relation', 100)->default('member')->comment('What is the contained for the container?');
            $table->smallInteger('contained_level')->default(0)->comment('Level of the relation in the container');
            $table->smallInteger('container_level')->default(0)->comment('Level of the relation for the contained');
            $table->timestamps();

            $table->unique(['contained_id', 'container_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relations');
    }
};
