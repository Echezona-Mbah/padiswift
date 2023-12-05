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
        Schema::create('data_princings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('network_id')->nullable();
            $table->string('network')->nullable();
            $table->string('api_plan_id')->nullable();
            $table->string('plan_type')->nullable();
            $table->string('plan_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('period')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_princings');
    }
};
