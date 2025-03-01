<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Discount;

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
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('cantidad', 'precio');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id');
    }

    public function favoritedByUsers()
    {
        return $this->hasMany(Favorite::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'products_id');
    }

    public function getDiscountedPriceAttribute()
    {
        $discount = $this->discount;

        if ($discount && now()->between($discount->fecha_inicio, $discount->fecha_fin)) {
            return $this->precio - ($this->precio * ($discount->valor / 100));
        }

        return $this->precio;
    }
}
