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
            $table->string('MTN_airtime_commision')->nullable();
            $table->string('Airtel_airtime_commision')->nullable();
            $table->string('GLO_airtime_commision')->nullable();
            $table->string('9mobile_airtime_commision')->nullable();
            $table->string('International_airtime_commision')->nullable();
            $table->string('MTN_data_commision')->nullable();
            $table->string('Airtel_data_commision')->nullable();
            $table->string('GLO_data_commision')->nullable();
            $table->string('9mobile_data_commision')->nullable();
            $table->string('Smile_data_commision')->nullable();
            $table->string('Spectranet_data_commision')->nullable();
            $table->string('IKEDC_electricity_commision')->nullable();
            $table->string('EKEDC_electricity_commision')->nullable();
            $table->string('KEDCO_electricity_commision')->nullable();
            $table->string('PHED_electricity_commision')->nullable();
            $table->string('JED_electricity_commision')->nullable();
            $table->string('IBEDC_electricity_commision')->nullable();
            $table->string('KAEDCO_electricity_commision')->nullable();
            $table->string('AEDC_electricity_commision')->nullable();
            $table->string('EEDCelectricity_commision')->nullable();
            $table->string('BEDC_electricity_commision')->nullable();
            $table->string('DSTV_cable_commision')->nullable();
            $table->string('GOTV_cable_commision')->nullable();
            $table->string('Startimes_cable_commision')->nullable();
            $table->string('Showmax_cable_commision')->nullable();
            $table->string('WAEC_Register_education_commision')->nullable();
            $table->string('WAEC_Result_education_commision')->nullable();
            $table->string('JAMB_Pin_education_commision')->nullable();
            $table->string('Motor_insurance_commision')->nullable();
            $table->string('Health_insurance_commision')->nullable();
            $table->string('Personal_Accident_insurance_commision')->nullable();
            $table->string('Home_Cover_insurance_commision')->nullable();
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
