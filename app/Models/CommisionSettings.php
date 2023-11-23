<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommisionSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'MTN_airtime_commision',
        'Airtel_airtime_commision',
        'GLO_airtime_commision',
        '9mobile_airtime_commision',
        'International_airtime_commision',
        'MTN_data_commision',
        'Airtel_data_commision',
        'GLO_data_commision',
        '9mobile_data_commision',
        'Smile_data_commision',
        'Spectranet_data_commision',
        'IKEDC_electricity_commision',
        'EKEDC_electricity_commision',
        'KEDCO_electricity_commision',
        'PHED_electricity_commision',
        'JED_electricity_commision',
        'IBEDC_electricity_commision',
        'KAEDCO_electricity_commision',
        'AEDC_electricity_commision',
        'EEDCelectricity_commision',
        'BEDC_electricity_commision',
        'DSTV_cable_commision',
        'GOTV_cable_commision',
        'Startimes_cable_commision',
        'Showmax_cable_commision',
        'WAEC_Register_education_commision',
        'WAEC_Result_education_commision',
        'JAMB_Pin_education_commision',
        'Motor_insurance_commision',
        'Health_insurance_commision',
        'Personal_Accident_insurance_commision',
        'Gift_Card_commision',
        'Flight_commision',
        'Betting_commision',
        'Social_Media_Managment_commision',
        'Showmax_cable_commision',


    ];
}
