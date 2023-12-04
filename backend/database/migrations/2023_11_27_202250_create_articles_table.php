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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable(); // Adding a column to store the external ID from the API response
            $table->string('source');
            $table->string('author')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url')->unique();
            $table->dateTime('published_at');
            $table->text('image_url')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
