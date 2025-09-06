<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nama tabel (kalau tabel di DB bernama 'produk')
    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'deskripsi',
        'price',
        'stock',
        'image',
    ];

    // Relasi ke Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
}
