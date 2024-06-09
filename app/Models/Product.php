<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock_level', 'category_id'];

    public function images()
    {
        return $this->hasMany(Image::class, 'imageable_id', 'id')->where('imageable_type', Product::class);
    }
}
