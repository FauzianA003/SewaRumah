<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik untuk kotak info admin
        $totalHouses = House::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();

        // 1. KODE BARU: Hitung total pendapatan dari transaksi yang sukses/confirmed
        $totalRevenue = Booking::whereIn('status', ['confirmed', 'success'])->sum('total_price');

        // 2. KODE BARU: Ambil akumulasi data pendapatan per bulan untuk grafik (Tahun Berjalan)
        $monthlyData = Booking::whereIn('status', ['confirmed', 'success'])
            ->whereYear('created_at', date('Y'))
            ->selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->all();

        // 3. KODE BARU: Susun urutan 12 bulan (Januari - Desember) dan beri nilai 0 jika bulan tersebut kosong
        $revenueMonths = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueMonths[] = $monthlyData[$i] ?? 0;
        }

        // Ambil riwayat sewa terbaru khusus milik user yang sedang login
        $myRecentBookings = Booking::where('user_id', Auth::id())->with('house')->latest()->take(3)->get();

        // Kirim semua variabel ke view dashboard
        return view('dashboard', compact(
            'totalHouses',
            'totalBookings',
            'pendingBookings',
            'totalRevenue',
            'revenueMonths',
            'myRecentBookings'
        ));
    }
}
