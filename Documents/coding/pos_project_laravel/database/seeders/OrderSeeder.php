<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'user_id'   => 1,
            'produk_id' => 1,
            'quantity'  => 2,
            'total'     => 100000,
            'status'    => 'paid',
        ]);
    }
}
