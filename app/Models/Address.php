<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Cambié 'users_id' por 'user_id'
        'calle',
        'ciudad',
        'provincia',
        'codigo_postal',
        'pais',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // También aquí
    }
}
