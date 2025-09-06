<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        DB::transaction(function () use ($cartItems, $user) {
            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }

            // Simpan order
            $order = Order::create([
                'user_id' => $user->id,
                'total'   => $total,
                'status'  => 'paid'
            ]);

            // Simpan order detail
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id, // kolom di tabel carts
                    'quantity' => $item->quantity,
                    'price'    => $item->product->price,
                ]);

                // hapus dari cart
                $item->delete();
            }
        });

        return redirect()->route('dashboard')->with('success', 'Checkout berhasil, pesanan dicatat!');
    }

    public function add($id)
    {
        $user = Auth::user();
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Product tidak ditemukan');
        }

        // Cek stok cukup
        if ($product->stock < 1) {
            return back()->with('error', 'Stok product habis!');
        }

        // Cek apakah item sudah ada di keranjang
        $existingItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += 1;
            $existingItem->save();
        } else {
            Cart::create([
                'user_id'   => $user->id,
                'product_id'=> $product->id,
                'quantity'  => 1
            ]);
        }

        // Kurangi stok
        $product->decrement('stock', 1);

        return back()->with('success', $product->nama . ' berhasil ditambahkan ke keranjang!');
    }

    public function showCart()
    {
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        return view('customer.cart', compact('cartItems'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $item = Cart::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        DB::transaction(function () use ($item) {
            $product = Produk::find($item->product_id);
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
            $item->delete();
        });

        return back()->with('success', 'Item berhasil dihapus dan stok dikembalikan');
    }

    public function clear()
    {
        $user = Auth::user();
        $items = Cart::where('user_id', $user->id)->get();

        DB::transaction(function () use ($items) {
            foreach ($items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock', $item->quantity);
                }
                $item->delete();
            }
        });

        return back()->with('success', 'Keranjang berhasil dikosongkan dan stok dikembalikan');
    }
}
