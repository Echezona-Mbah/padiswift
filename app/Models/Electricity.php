<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transactionId',
        'purchasedToken',
        'customerName',
        'units',
        'requestId',
        'amount',
        'cashback',
        'product_name',
        'type',
        'email',
        'phone',
        'status',
    ];

    protected $table ='electricities';

    protected $primaryKey ='id';


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
