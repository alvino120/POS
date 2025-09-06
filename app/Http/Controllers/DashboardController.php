<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {        // Total pendapatan hari ini
        $todayRevenue = Order::whereBetween('updated_at', [now()->startOfDay(), now()->endOfDay()])
            ->where('status', 'paid')
            ->sum('total');
        $monthRevenue = Order::whereYear('updated_at', now()->year)
            ->whereMonth('updated_at', now()->month)
            ->where('status', 'paid')
            ->sum('total');



        // Hitung total produk & user
        $totalProducts = Product::count();
        $totalUsers = User::count();

        // Kirim ke view
        return view('admin.dashboard', compact(
            'todayRevenue',
            'monthRevenue',
            'totalProducts',
            'totalUsers'
        ));
    }
}
