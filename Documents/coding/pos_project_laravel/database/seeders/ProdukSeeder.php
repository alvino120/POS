<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset data agar tidak duplikasi ketika seeding ulang
        // gunakan delete agar tidak bentrok dengan foreign key carts
        Product::query()->delete();

        Product::insert([
            [
                'name' => 'Hilang di Dekapan Semeru',
                'description' => 'Novel petualangan',
                'price' => 100000,
                'stock' => 100,
                'image_path' => 'download (1).jpeg',
            ],
            [
                'name' => 'Tanah Jawa',
                'description' => 'Kisah horor tanah Jawa',
                'price' => 70000,
                'stock' => 100,
                'image_path' => '52643.jpg',
            ],
            [
                'name' => 'Sewu Dino',
                'description' => 'Novel horor',
                'price' => 75000,
                'stock' => 100,
                'image_path' => 'sewu-dino.jpg',
            ],
            [
                'name' => 'Dunia Makhluk Halus',
                'description' => 'Cerita misteri',
                'price' => 85000,
                'stock' => 100,
                'image_path' => 'download (3).jpeg',
            ],
            [
                'name' => 'Haru Mahameru',
                'description' => 'Novel',
                'price' => 105000,
                'stock' => 100,
                'image_path' => '9786026714688_HARU_MAHAMERU_front.jpg',
            ],
        ]);
    }
}
