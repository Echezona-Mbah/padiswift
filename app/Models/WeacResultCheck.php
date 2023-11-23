<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeacResultCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transactionId',
        'Serial_No',
        'Pin_No',
        'requestId',
        'amount',
        'cashback',
        'product_name',
        'type',
        'email',
        'phone',
        'status',
    ];

    protected $table ='weac_result_checks';

    protected $primaryKey ='id';


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
