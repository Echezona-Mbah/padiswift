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
        Schema::create('social_medai_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_id')->unique();
            $table->string('category_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('order_amount_per_unit')->nullable();
            $table->string('order_default_unit')->nullable();
            $table->string('order_link')->nullable();
            $table->string('ordered_unit_quantity')->nullable();
            $table->string('order_status')->nullable();
            $table->string('order_amount_charged')->nullable();
            $table->string('order_unit_remains')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_medai_orders');
    }
};
