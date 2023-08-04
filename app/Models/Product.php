<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'users_id',
        'categories_id',
        'price',
        'description',
    ];

    protected $hidden = [];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'categories_id');
    }

    public function galleries() {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }
    
    public function user() {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

}
