<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use RealRashid\SweetAlert\Facades\Alert;

class CetakBarangMasuk extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Cetak Barang Masuk | Inv-Cafe',
            'barang_masuk' => BarangMasuk::all(),
        );

        return view('admin.cetak.cetak_masuk', $data);
    }

    public function cetakmasuk($tanggal_awal, $tanggal_akhir)
    {
        // dd("Tanggal Awal : " . $tanggal_awal, "Tanggal Akhir : " . $tanggal_akhir);

        $masukPertanggal = BarangMasuk::whereBetween('tanggal_masuk', [$tanggal_awal, $tanggal_akhir])->get();

        return view('admin.cetak.hasil-masuk', compact('masukPertanggal'));
    }
}
