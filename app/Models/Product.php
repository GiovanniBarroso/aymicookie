<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categories_id',
        'brands_id'
    ];

    // Relación con Categoría
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    // Relación con Marca
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id');
    }
}
