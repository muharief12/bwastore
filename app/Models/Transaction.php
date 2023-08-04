<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'users_id', 'insurance_price', 'shipping_price', 'total_price', 'transaction_status'
    ];

    protected $hidden = [
        
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
        // return $this->hasOne(User::class, 'id', 'user_id');
    }

}
