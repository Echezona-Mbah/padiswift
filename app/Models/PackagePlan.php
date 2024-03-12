<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_name',
        'reg_fee',
        'reg_bonus',
        'level_commission',
        'point_value',
    ];
}
