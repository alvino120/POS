<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel orders.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Relasi ke tabel users
            $table->unsignedBigInteger('produk_id'); // Relasi ke tabel produk
            $table->integer('quantity'); // Jumlah barang
            $table->decimal('total', 10, 2); // Total harga
            $table->string('status')->default('pending'); // Status order: pending, paid, cancelled
            $table->timestamps(); // Kolom created_at & updated_at

            // Foreign key opsional (hapus kalau bikin error)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Rollback migration (hapus tabel orders).
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
