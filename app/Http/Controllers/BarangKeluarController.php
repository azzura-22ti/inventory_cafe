<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Barang;
use App\Models\BarangKeluar;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Barang Masuk | Inv-Cafe',
            'barang_keluar' => BarangKeluar::all(),
            'data_barang' => Barang::all(),
        );

        return view('gudang.barang_keluar', $data);
    }

    public function store(Request $request, $id)
    {
        BarangKeluar::create([
            'nama_barang' => $request->nama_barang,
            'nama_kategori' => $request->nama_kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'tanggal_keluar' => $request->tanggal_keluar,
            'jumlah_keluar' => $request->jumlah_keluar,
        ]);

        $barang = Barang::find($id);

        $data = array(
            'title' => 'Barang Masuk | Inv-Cafe',
            'barang_keluar' => BarangKeluar::all(),
            'data_barang' => Barang::all(),
        );

        if ($barang) {
            if ($barang->stok >= $request->jumlah_keluar && $request->jumlah_keluar > 0) {
                $barang->stok -= $request->jumlah_keluar;
                $barang->save();
                Alert::success('Berhasil', 'Data berhasil dikurangi!');
            } elseif ($barang->stok < $request->jumlah_keluar) {
                Alert::error('Gagal', 'Jumlah Permintaan Lebih Dari Stok');
            } else {
                Alert::error('Gagal', 'Jumlah Barang yang Dikeluarkan Tidak Valid');
            }
        } else {
            Alert::error('Gagal', 'Barang Tidak Ditemukan!');
        }

        return view('gudang.barang_keluar', $data);
    }
}
