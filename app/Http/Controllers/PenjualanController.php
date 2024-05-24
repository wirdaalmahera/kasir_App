<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\TransaksiDetail;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
// use App\Models\Transaksi;
// use App\Models\TransaksiSementara;
// use App\Models\TransaksiDetail;

class PenjualanController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiDetail::with(['pelanggan', 'user'])->get();
        // $transaksi->pelanggan;

        return view('penjualan.index', compact('transaksi'));
    }

    public function showDetail($id)
{
    // Temukan transaksi berdasarkan ID
    $transaksi = TransaksiDetail::findOrFail($id);

    // Kembalikan view dengan data transaksi
    return view('penjualan.showDetail', compact('transaksi'));
}



    public function form(Request $request)
    {
        $produk = Produk::get();
        $pelanggan = Pelanggan::get();

        $produk_id = request('produk_id');
        $data = Produk::find($produk_id);

        $pelanggan_id = request('pelanggan_id');
        $dt = Pelanggan::find($pelanggan_id);

        $jumlah = $request->input('jumlah', 1);

        $act = request('act');
        $jumlah = request('jumlah');
        if ($act == 'min') {
            if ($jumlah <= 1) {
                $jumlah = 1;
            } else {
                $jumlah = $jumlah - 1;
            }
        } else {
            $jumlah = $jumlah + 1;
        }

        $subtotal = 0;
        if ($data) {
            $subtotal = $jumlah * $data->harga;
        }

        return view('penjualan.dataBarang', compact('produk', 'pelanggan', 'data', 'dt', 'jumlah', 'subtotal'));
    }

    public function store(Request $request)
    {
        // Validasi data permintaan jika diperlukan
    
        $produk_id = $request->input('produk_ids');
        $pelanggan_id = $request->input('pelanggan_id');
        $jumlah = $request->input('jumlah');
        $total =  $request->input('total');// Mendapatkan nilai jumlah dari permintaan
    
       

        foreach($produk_id as $key =>$value){
        $produk = Produk::find($value);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
    
        if ($produk->stock < $jumlah[$key]) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $data = [
            'produk_id' => $value,
            'pelanggan_id' => $pelanggan_id,
            'jumlah' => $jumlah[$key], // Menggunakan nilai $jumlah yang sudah didapatkan
            'harga' => $produk->harga,
            'total' => $request->total
        ];  
        TransaksiDetail::create($data);
        
        $stok = [
            'stock' => $produk->stock - $jumlah[$key] // Menggunakan $jumlah yang sudah didapatkan
        ];

        $produk->update($stok);
        }
    
        // Update stock
  
     
    
        return redirect('/kasir/penjualan')->with('success', 'Pembelian berhasil.');
    }

    

    public function exportPDF()
    {
        $transaksiDetails = TransaksiDetail::all();

    
        // Create a new Dompdf instance
        $pdf = new Dompdf();
    
        // Load HTML content into Dompdf
        $pdf->loadHtml(view('pdf.transaksi', compact('transaksiDetails')));
    
        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
    
        // Render the PDF
        $pdf->render();
    
        // Download the PDF file
        return $pdf->stream('laporan-transaksi.pdf');
    }
    
    public function delete($id)
{   
    try {
        // Temukan transaksi berdasarkan ID
        $transaksi = TransaksiDetail::findOrFail($id);
        
        // Hapus transaksi
        $transaksi->delete();

        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus.');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Gagal menghapus data transaksi. Silakan coba lagi.');
    }
}

    



}