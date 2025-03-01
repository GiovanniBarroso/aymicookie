<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'addresses_id',
        'vouchers_id',
        'fecha_pedido',
        'estado',
        'total',
    ];
    public $timestamps = true;

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relación con la dirección del usuario
    public function address()
    {
        return $this->belongsTo(Address::class, 'addresses_id');
    }

    // Relación con los cupones de descuento
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'vouchers_id');
    }
    // En App\Models\Order.php

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('cantidad', 'precio');  // Si deseas almacenar la cantidad y el precio
    }
}
