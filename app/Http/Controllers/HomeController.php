<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function chart()
    {
        $chart = BarangMasuk::select('tanggal_masuk')->get();

        return response()->json($chart);
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard | Inv-Cafe',
            'data_barang' => Barang::all(),
        );

        return view('home', $data);
    }
}
