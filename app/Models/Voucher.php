<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'descuento',
        'tipo', // Puede ser 'fijo' o 'porcentaje'
        'fecha_expiracion',
        'estado' // Activo o Inactivo
    ];

    // Relación con los pedidos que han utilizado este cupón
    public function orders()
    {
        return $this->hasMany(Order::class, 'vouchers_id');
    }
}
