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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_domain_name')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_whatsapp_number')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_office_address')->nullable();
            $table->string('site_facebook_link')->nullable();
            $table->string('site_instagram_link')->nullable();
            $table->string('site_linkedin_link')->nullable();
            $table->string('site_twitter_link')->nullable();
            $table->string('site_youtube_link')->nullable();
            $table->string('site_status')->default('yes'); //no
            $table->string('site_default_account_name')->nullable();
            $table->string('site_default_account_number')->nullable();
            $table->string('site_default_bank_name')->nullable();
            $table->string('site_google_download_link')->nullable();
            $table->string('site_apple_download_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
