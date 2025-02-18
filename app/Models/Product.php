<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'description',
        'precio',
        'stock',
        'categories_id',
        'brands_id',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id');
    }
}
