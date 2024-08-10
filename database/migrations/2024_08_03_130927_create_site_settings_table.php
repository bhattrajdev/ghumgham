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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title', 255);
            $table->text('description')->nullable();
            $table->string('email', 255);
            $table->string('image', 255)->nullable();
            $table->string('alternate_email', 255)->nullable();
            $table->string('phone_number1', 255)->nullable();
            $table->string('phone_number2', 255)->nullable();
            $table->string('twitter_link', 255)->nullable();
            $table->string('fb_link', 255)->nullable();
            $table->string('insta_link', 255)->nullable();
            $table->string('tiktok_link', 255)->nullable();
            $table->string('youtube_link', 255)->nullable();
            $table->string('video_banner_link', 255)->nullable();
            $table->string('address1', 500)->nullable();
            $table->string('address2', 500)->nullable();
            $table->string('map_link', 500)->nullable();
            $table->string('footer_info', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
