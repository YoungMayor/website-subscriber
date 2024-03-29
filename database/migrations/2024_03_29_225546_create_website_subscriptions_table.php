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
        Schema::create('website_subscriptions', function (Blueprint $table) {
            $table->foreignUlid('website_ulid')->constrained('websites', 'ulid')->cascadeOnDelete();
            $table->foreignUlid('user_ulid')->constrained('users', 'ulid')->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['website_ulid', 'user_ulid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_subscriptions');
    }
};
