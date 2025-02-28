<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'description',
        'tipo',
        'valor',
        'fecha_inicio',
        'fecha_fin',
        'products_id',
        'activo'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
