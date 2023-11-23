<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaecRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transactionId',
        'purchasedToken',
        'requestId',
        'amount',
        'cashback',
        'product_name',
        'type',
        'email',
        'phone',
        'status',
    ];

    protected $table ='waec_registers';

    protected $primaryKey ='id';


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
