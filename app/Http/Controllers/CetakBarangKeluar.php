<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use RealRashid\SweetAlert\Facades\Alert;

class CetakBarangKeluar extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Laporan Barang | Inv-Cafe',
            'barang_keluar' => BarangKeluar::all(),
        );

        return view('admin.cetak.cetak_keluar', $data);
    }

    public function cetakkeluar($tanggal_awal, $tanggal_akhir)
    {
        // dd("Tanggal Awal : " . $tanggal_awal, "Tanggal Akhir : " . $tanggal_akhir);

        $keluarPertanggal = BarangKeluar::whereBetween('tanggal_keluar', [$tanggal_awal, $tanggal_akhir])->get();

        return view('admin.cetak.hasil-keluar', compact('keluarPertanggal'));
    }
}
