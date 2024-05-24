<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Produk;


class PelangganController extends Controller
{
    public function user()
    {
        return view('penjualan.user');
    }

    public function index()
    {
        $user = Pelanggan::all();
        return view('penjualan.pelanggan', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required', 
            'no_telp' => 'required',
            'pelanggan_id' => 'required',
        ]);
        //tambah data ke database
        
        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'pelanggan_id' => $request->pelanggan_id,
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect('/kasir/penjualan/pelanggan')->with('successAdd','Berhasil menambahkan produk!');
    }

    public function edit($id)
{
    $user = Pelanggan::find($id);
    
    if (!$user) {
        return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan.');
    }
    
    return view('penjualan.editPelanggan', compact('user'));
}

public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required', 
            'no_telp' => 'required',
            'pelanggan_id' => 'required',
        ]);
        
        // Temukan data pengguna yang ingin diperbarui
        $user = Pelanggan::findOrFail($id);
    
        // Perbarui atribut-atributnya satu per satu
        $user->nama_pelanggan = $request->nama_pelanggan;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->pelanggan_id = $request->pelanggan_id;
        // Simpan perubahan
        $user->save();
        
        // Redirect setelah berhasil dengan pesan sukses
        return redirect('/kasir/penjualan/pelanggan')->with('successAdd','Berhasil mengupdate data!');
    }

    public function delete($id)
    {
        $pelanggan = Pelanggan::find($id);
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'User not found.');
        }
        
        $pelanggan->delete();

        return redirect()->route('/kasir/penjualan/pelanggan')->with('success', 'User deleted successfully.');
    }
    
}
