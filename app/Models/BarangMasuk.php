<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'nama_barang', 'nama_kategori', 'stok', 'satuan', 'harga', 'expired_date', 'tanggal_masuk', 'jumlah_masuk',
    ];

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
