<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCostController extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_tax',
        'product_insurance',
        'shipping_cost',
    ];

    protected $hidden = [];
}
