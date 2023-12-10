<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Barang;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Barang Masuk | Inv-Cafe',
            'barang_masuk' => BarangMasuk::all(),
            'data_barang' => Barang::all(),
        );

        return view('gudang.barang_masuk', $data);
    }

    public function store(Request $request, $id)
    {
        BarangMasuk::create([
            'nama_barang' => $request->nama_barang,
            'nama_kategori' => $request->nama_kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
        ]);

        $barang = Barang::find($id);

        if ($barang) {
            $barang->stok += $request->jumlah_masuk;
            $barang->save();
        }

        $data = array(
            'title' => 'Barang Masuk | Inv-Cafe',
            'barang_masuk' => BarangMasuk::all(),
            'data_barang' => Barang::all(),
        );

        Alert::success('Berhasil', 'Data berhasil ditambahkan!');

        return view('gudang.barang_masuk', $data);
    }
}
