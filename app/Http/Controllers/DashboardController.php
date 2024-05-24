<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        $produk = Produk::all();
        // $transaksi = Transaksi::all();
        // $detail = TransaksiDetail::orderBy('created_at', 'desc')->get();
        
        // $stok_kosong = Barang::where('stok', 0)->get();

        // $hari_ini = Carbon::now()->format('Y-m-d');
        // $transaksi_hari_ini = Transaksi::whereDate('tanggal', $hari_ini)->get();

        return view('dashboard.index', compact('produk'));
    }
}
