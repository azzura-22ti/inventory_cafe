<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Barang | Inv-Cafe',
            'data_barang' => Barang::all(),
        );

        return view('admin.barang.list', $data);
    }

    public function store(Request $request)
    {
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'nama_kategori' => $request->nama_kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan!');

        return redirect('/barang');
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'nama_kategori' => $request->nama_kategori,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah!');

        return redirect('/barang');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        $barang->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');

        return redirect('/barang');
    }
}


// value stok sekarang
