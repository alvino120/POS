<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // Ambil user yang sedang login

        if ($user->level !== 'customer') {
            abort(403, 'Unauthorized action.');
        }

        $products = Product::all(); // Ambil semua produk

        return view('customer.dashboard', compact('products')); // Kirim ke view
    }
}
