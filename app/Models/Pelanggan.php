<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelanggan_id',
        'nama_pelanggan',
        'alamat',
        'no_telp',
    ];

    public function TransaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'pelanggan_id');
    }
}
