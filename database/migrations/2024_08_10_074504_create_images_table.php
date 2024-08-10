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
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alt', 255);
            $table->text('file_name');
            $table->string('slug', 255);
            $table->string('imageable_type', 50);
            $table->unsignedInteger('imageable_id');
            $table->enum('type', ['cover', 'feature', 'gallery', 'doc']);
            $table->unsignedInteger('order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
