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
        Schema::create('commision_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mtn')->nullable();
            $table->string('glo')->nullable();
            $table->string('airtel')->nullable();
            $table->string('etisalat')->nullable();
            $table->string('International_airtime_commision')->nullable();
            $table->string('mtn-data')->nullable();
            $table->string('airtel-data')->nullable();
            $table->string('glo-data')->nullable();
            $table->string('etisalat-data')->nullable();
            $table->string('smile-direct')->nullable();
            $table->string('spectranet')->nullable();
            $table->string('ikeja-electric')->nullable();
            $table->string('eko-electric')->nullable();
            $table->string('kano-electric')->nullable();
            $table->string('portharcourt-electric')->nullable();
            $table->string('jos-electric')->nullable();
            $table->string('ibadan-electric')->nullable();
            $table->string('kaduna-electric')->nullable();
            $table->string('abuja-electric')->nullable();
            $table->string('enugu-electric')->nullable();
            $table->string('benin-electric')->nullable();
            $table->string('dstv')->nullable();
            $table->string('gotv')->nullable();
            $table->string('startimes')->nullable();
            $table->string('showmax')->nullable();
            $table->string('waec-registration')->nullable();
            $table->string('waec')->nullable();
            $table->string('jamb')->nullable();
            $table->string('insure')->nullable();
            $table->string('health-insurance')->nullable();
            $table->string('personal-accident-insurance')->nullable();
            $table->string('health-insurance-rhl')->nullable();
            $table->string('Gift_Card_commision')->nullable();
            $table->string('Flight_commision')->nullable();
            $table->string('Betting_commision')->nullable();
            $table->string('Social_Media_Managment_commision')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commision_settings');
    }
};
