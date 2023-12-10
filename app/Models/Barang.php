<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang','nama_kategori','stok','satuan','harga'
    ];

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
