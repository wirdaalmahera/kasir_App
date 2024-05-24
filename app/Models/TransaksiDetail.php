<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;
use App\Models\Produk;
use App\Models\Pelanggan;

class TransaksiDetail extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    protected $fillable = [
        'produk_id',
        'total',
        'harga',
        'jumlah',
        'pelanggan_id',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class,'penjualan_id','id');
    }

    
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Dalam model TransaksiDetail
public function tanggal_penjualan()
{
    return $this->belongsTo('App\Models\TanggalPenjualan', 'foreign_key');
}

public function details()
{
    return $this->hasMany('App\Models\DetailModel');
}



}
