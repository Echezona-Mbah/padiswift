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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('padi_tag')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('sex')->nullable();
            $table->string('dob')->nullable();
            $table->string('occupation')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('country')->nullable();
            $table->string('home_address')->nullable();
            $table->string('wallet_balance')->nullable();
            $table->string('cashback_balance')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('password')->nullable();
            $table->string('transaction_pin')->nullable();
            $table->string('referral_padi_tag')->nullable();
            $table->string('security_login_otp')->nullable();
            $table->string('login_otp_expires_at')->nullable();
            $table->string('email_verification_otp')->nullable();
            $table->string('email_verification_otp_expires_at')->nullable();
            $table->string('email_verified_status')->default('no');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('forgot_password_code')->nullable();
            $table->string('forgot_password_token')->nullable();
            $table->string('forget_password_otp_expires_at')->nullable();
            $table->string('phone_verified_status')->default('no');
            $table->string('kyc_status')->default('pending'); //verified
            $table->string('kyc_id_type')->nullable();
            $table->string('kyc_document')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
