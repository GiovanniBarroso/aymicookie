<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'direccion',
        'ciudad',
        'codigo_postal',
        'pais',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
