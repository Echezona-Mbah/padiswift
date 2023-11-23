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
        Schema::create('t_v_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('transactionId');
            $table->string('Customer_Name')->nullable();
            $table->string('DUE_DATE')->nullable();
            $table->string('Customer_Number')->nullable();
            $table->string('Customer_Type')->nullable();
            $table->string('Current_Bouquet')->nullable();
            $table->string('Current_Bouquet_Code')->nullable();
            $table->string('Renewal_Amount')->nullable();
            $table->string('subscription_type')->nullable();
            $table->string('serviceID');
            $table->string('requestId');
            $table->string('amount');
            $table->string('cashback')->nullable();
            $table->string('product_name'); //"MTN Data"
            $table->string('type')->nullable(); //"Data Services"
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('t_v_subscriptions');
    }
};
