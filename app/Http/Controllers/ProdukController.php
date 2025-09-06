<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('produk.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }
}
