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
        Schema::create('social_medai_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_id')->unique();
            $table->string('category_id')->nullable();
            $table->string('service_title')->nullable();
            $table->string('service_description')->nullable();
            $table->string('amount_per_unit')->nullable();
            $table->string('default_unit')->nullable();
            $table->string('average_time')->nullable();
            $table->string('status')->default('hide'); //show
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_medai_services');
    }
};
