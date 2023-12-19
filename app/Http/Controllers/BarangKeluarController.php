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
        $barang = Barang::find($id);

        if ($barang) {
            if ($barang->stok >= $request->jumlah_keluar && $request->jumlah_keluar > 0) {
                $barangKeluar = new BarangKeluar([
                    'nama_barang' => $request->nama_barang,
                    'nama_kategori' => $request->nama_kategori,
                    'stok' => $request->stok,
                    'satuan' => $request->satuan,
                    'harga' => $request->harga,
                    'tanggal_keluar' => $request->tanggal_keluar,
                    'jumlah_keluar' => $request->jumlah_keluar,
                ]);
                $barangKeluar->save();

                $barang->stok -= $request->jumlah_keluar;
                $barang->save();

                $data = array(
                    'title' => 'Barang Masuk | Inv-Cafe',
                    'barang_keluar' => BarangKeluar::all(),
                    'data_barang' => Barang::all(),
                );

                Alert::success('Berhasil', 'Data berhasil dikurangi!');
                return view('gudang.barang_keluar', $data);
            } elseif ($barang->stok < $request->jumlah_keluar) {
                Alert::error('Gagal', 'Jumlah Permintaan Lebih Dari Stok');
            } else {
                Alert::error('Gagal', 'Jumlah Barang yang Dikeluarkan Tidak Valid');
            }
        } else {
            Alert::error('Gagal', 'Barang Tidak Ditemukan!');
        }

        return redirect()->back();
    }
}
