<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVSubscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transactionId',
        'Customer_Name',
        'DUE_DATE',
        'Customer_Number',
        'Customer_Type',
        'Current_Bouquet',
        'Current_Bouquet_Code',
        'Renewal_Amount',
        'subscription_type',
        'serviceID',
        'requestId',
        'amount',
        'cashback',
        'product_name',
        'type',
        'email',
        'phone',
        'status',
    ];

    protected $table ='t_v_subscriptions';

    protected $primaryKey ='id';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
