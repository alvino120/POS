<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AuthController extends Controller
{

    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->level === 'admin' || $user->level === 'manager') {
            // Aggregate sales data from transactions; if none yet, fallback to carts
            $todayRevenue = Transaction::whereDate('created_at', now()->toDateString())->sum('harga_total');
            $totalSales = Transaction::sum('harga_total');

            if ($todayRevenue == 0 && $totalSales == 0) {
                $todayRevenue = (float) DB::table('carts')
                    ->join('produk', 'carts.product_id', '=', 'produk.id')
                    ->whereDate('carts.created_at', now()->toDateString())
                    ->sum(DB::raw('carts.quantity * produk.price'));

                $totalSales = (float) DB::table('carts')
                    ->join('produk', 'carts.product_id', '=', 'produk.id')
                    ->sum(DB::raw('carts.quantity * produk.price'));
            }

            $totalUsers = User::count();
            $newClientsQuarter = User::where('created_at', '>=', now()->subMonths(3))->count();

            // Recent orders: prefer transactions; fallback to carts
            $recentOrders = Transaction::with(['customer', 'produk'])
                ->latest()
                ->take(10)
                ->get();

            if ($recentOrders->isEmpty()) {
                $recentOrders = Cart::with(['user', 'product'])
                    ->latest()
                    ->take(10)
                    ->get();
            }

            // Sales overview: monthly totals for last 12 months
            $start = now()->subMonths(11)->startOfMonth();
            $labels = [];
            $monthlyTotals = [];

            // Check if there are any transactions in range
            $hasTransactions = Transaction::where('created_at', '>=', $start)->exists();

            for ($i = 0; $i < 12; $i++) {
                $monthStart = (clone $start)->addMonths($i);
                $monthEnd = (clone $monthStart)->endOfMonth();
                $labels[] = $monthStart->format('M Y');

                if ($hasTransactions) {
                    $sum = Transaction::whereBetween('created_at', [$monthStart, $monthEnd])
                        ->sum('harga_total');
                } else {
                    $sum = (float) DB::table('carts')
                        ->join('produk', 'carts.product_id', '=', 'produk.id')
                        ->whereBetween('carts.created_at', [$monthStart, $monthEnd])
                        ->sum(DB::raw('carts.quantity * produk.price'));
                }

                $monthlyTotals[] = (float) $sum;
            }

            return view('admin.dashboard', [
                'todayRevenue' => $todayRevenue,
                'totalUsers' => $totalUsers,
                'newClientsQuarter' => $newClientsQuarter,
                'totalSales' => $totalSales,
                'recentOrders' => $recentOrders,
                'salesChart' => [
                    'labels' => $labels,
                    'data' => $monthlyTotals,
                ],
            ]);
        } elseif ($user->level === 'customer') {
            $product = \App\Models\Product::all();
            return view('customer.dashboard', compact('product'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }


    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // login user setelah register

        return redirect()->route('dashboard');
    }


    // Login user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // ✅ masuk dashboard setelah login
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    public function dashboardPage()
    {
        return view('dashboard'); // pastikan ada file resources/views/dashboard.blade.php
    }

    public function logout(Request $request)
    {
        Auth::logout(); // logout user

        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // regenerate CSRF token

        return redirect('/login'); // ✅ balik ke login setelah logout
    }
}
