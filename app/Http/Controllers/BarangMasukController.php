<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Carbon\Carbon;

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
        $barang = Barang::find($id);

        if ($barang) {
            $jumlah_masuk = $request->jumlah_masuk;

            // Update stok barang yang ada
            $barang->stok += $jumlah_masuk;
            $barang->save();

            // Buat entri baru di BarangMasuk
            $barangMasuk = new BarangMasuk([
                'nama_barang' => $barang->nama_barang,
                'nama_kategori' => $barang->nama_kategori,
                'stok' => $jumlah_masuk,
                'satuan' => $barang->satuan,
                'harga' => $barang->harga,
                'expired_date' => $request->expired_date, // Gunakan expired date dari Barang
                'tanggal_masuk' => $request->tanggal_masuk,
                'jumlah_masuk' => $jumlah_masuk,
            ]);
            $barangMasuk->save();

            // Ambil data barang yang memiliki expired date
            $data_barang_expired = BarangMasuk::whereNotNull('expired_date')->get();

            // Filter data yang expired date-nya dalam rentang tertentu
            $data_barang_near_expired = $data_barang_expired->filter(function ($item) {
                $expiredDate = \Carbon\Carbon::parse($item->expired_date);
                $now = \Carbon\Carbon::now();
                $daysUntilExpiration = $now->diffInDays($expiredDate, false);
                return $daysUntilExpiration <= 7 && $daysUntilExpiration >= 0;
            });

            // Tampilkan notifikasi yang sudah diperbarui di view
            $data = [
                'title' => 'Barang Masuk | Inv-Cafe',
                'barang_masuk' => BarangMasuk::all(),
                'data_barang' => $data_barang_near_expired,
            ];

            Alert::success('Berhasil', 'Data berhasil ditambahkan!');

            return view('gudang.barang_masuk', $data);
        }
    }
}
