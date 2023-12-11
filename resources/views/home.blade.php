@extends('layouts.layout')

@section('content')
<h1 class="h3 mb-2 text-gray-800 mb-4">Dashboard</h1>

@if (auth()->user()->level == 'gudang')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="fw-semibold">Pemberitahuan Stok Menipis</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp

                    @foreach ($data_barang as $db)
                    @if ($db->stok <= 5) <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            <span class="fw-medium">{{ $db->nama_barang }}</span>
                        </td>
                        <td>{{ $db->nama_kategori }}</td>
                        <td>{{ $db->stok }}</td>
                        <td>{{ $db->satuan }}</td>
                        <td>Rp. {{ number_format($db->harga) }}</td>
                        <td>
                            <a href="/barang_masuk" class="btn btn-primary text-center"><i class='menu-icon tf-icons bx bx-plus'></i> Tambah</a>

                        </td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- chart -->
<div class="row">
    <div class="card shadow mb-4 col-7" style="margin-right: 20px; margin-left:10px;">
        <div class="card-header py-3 mt-2">
            <h4 class="fw-semibold">Laporan Barang Per-Bulan</h4>
        </div>
        <div class="card-body">
            <div id="barchart"></div>
        </div>
    </div>
    <div class="card shadow col-4">
        <div class="card-header py-3">
            <h4 class="fw-semibold mt-3">Laporan Barang Total</h4>
        </div>
        <div class="card-body">
            <div id="piechart"></div>
        </div>
    </div>
</div>

@endsection
