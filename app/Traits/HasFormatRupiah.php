<?php

namespace App\Traits;

trait HasFormatRupiah
{
    // function formatRupiah($field, $prefix = null)
    // {
    //     $prefix = $prefix ? $prefix : 'Rp. ';
    //     return $prefix . number_format($this->attributes[$field], $nominal, 0, ',', '.');
    // }

    function formatRupiah($field)
    {
        $nominal = $this->attributes[$field];
        return number_format($nominal, 0, ',', '.');
    }
}