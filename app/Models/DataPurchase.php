<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPurchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transactionId',
        'amount',
        'cashback',
        'product_name',
        'email',
        'phone',
        'status',
        'serviceID',
    ];

    protected $table ='data_purchases';

    protected $primaryKey ='id';


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // public function airtimes()
    // {
    //     return $this->belongsTo(Airtime::class);
    // }
}
