<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Dashboard | Inv-Cafe',
            'data_barang' => Barang::all(),
        );

        return view('home', $data);
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
}
