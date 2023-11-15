<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'topup_type',


    ];

    protected $table ='topups';

    protected $primaryKey ='id';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
