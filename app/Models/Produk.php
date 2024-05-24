<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransaksiDetail;

// use App\Models\TransaksiDetail;
// use App\Models\TransaksiSementara;
// use App\Models\TransaksiDetail;
use App\Traits\HasFormatRupiah;
// use App\Traits\HasFormatRupiah;

class Produk extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    // use HasFormatRupiah;
    protected $fillable = [
        'id',
        'nama_produk',
        'image',
        'harga',
        'stock',
    ];

    protected $guarded = [];

    // public function TransaksiSementara()
    // {
    //     return $this->hasMany(TransaksiSementara::class);
    // }

    public function TransaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }


}
