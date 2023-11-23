<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airtime extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transactionId',
        'requestId',
        'amount',
        'cashback',
        'product_name',
        'type',
        'email',
        'phone',
        'status',
    ];

    protected $table ='airtimes';

    protected $primaryKey ='id';


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // public function data_purchases()
    // {
    //     return $this->hasMany(DataPurchase::class);
    // }
}
