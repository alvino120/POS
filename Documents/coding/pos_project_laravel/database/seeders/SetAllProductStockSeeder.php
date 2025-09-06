<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class SetAllProductStockSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->update(['stock' => 100]);
    }
}
