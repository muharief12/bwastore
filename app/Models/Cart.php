<?php

namespace App\Models;

use App\Models\Admin\AdminCostController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'products_id',
        'users_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function admincost()
    {
        return $this->hasOne(AdminCostController::class, 'id', 'admincost_id');
    }

}
