<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Dashboard | Inv-Cafe',
            'data_barang' => Barang::all(),
        );

        $user = User::count();
        $jumlah_barang = Barang::count();
        $jumlah_masuk = BarangMasuk::count();
        $jumlah_keluar = BarangKeluar::count();

        return view('home', $data)->with('user', $user)->with('jumlah_barang', $jumlah_barang)->with('jumlah_masuk', $jumlah_masuk)->with('jumlah_keluar', $jumlah_keluar);
    }

    public function barangMasuk()
    {
        $currentYear = Carbon::now()->year;
        $stocks = BarangMasuk::select(DB::raw('COUNT(nama_barang) as total'), DB::raw('MONTH(tanggal_masuk) as month'))
            ->whereYear('tanggal_masuk', $currentYear)
            ->groupBy(DB::raw('MONTH(tanggal_masuk)'))
            ->get();

        return response()->json($stocks);
    }

    public function barangKeluar()
    {
        $currentYear = Carbon::now()->year;
        $stocks = BarangKeluar::select(DB::raw('COUNT(nama_barang) as total'), DB::raw('MONTH(tanggal_keluar) as month'))
            ->whereYear('tanggal_keluar', $currentYear)
            ->groupBy(DB::raw('MONTH(tanggal_keluar)'))
            ->get();

        return response()->json($stocks);
    }
}
