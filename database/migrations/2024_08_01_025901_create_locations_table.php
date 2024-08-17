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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->string('latitude')->nullable();
            $table->string('carousel_text')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            $table->longText('description')->nullable();
            $table->longText('route')->nullable();
            $table->enum('phase', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
