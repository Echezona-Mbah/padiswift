<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetWorkImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename',
        'network_type',
    ];
}
