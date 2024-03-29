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
        Schema::create('posts', function (Blueprint $table) {
            $table->ulid()->primary();
            $table->foreignUlid('website_ulid')->constrained('websites', 'ulid');
            $table->foreignUlid('author_ulid')->constrained('users', 'ulid');
            $table->string('title');
            $table->text('description');
            $table->string('slug');
            $table->json('keywords')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
