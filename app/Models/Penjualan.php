<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_penjualan',
        'total',
        'pelanggan_id',
    ];

    public function TransaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
