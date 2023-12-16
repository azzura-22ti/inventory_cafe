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

@if(auth()->user()->level == 'admin')
<div class="row">
    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <span class="badge rounded-pill bg-label-primary"><i class='bx bxs-user'></i></span>
                    <span>Jumlah User</span>
                </div>
                <h3 class="card-title mb-2">{{ $user }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title">

                    <span class="badge rounded-pill bg-label-info"><i class='bx bx-box'></i></span>
                    <span>Jumlah Barang</span>


                </div>
                <h3 class="card-title text-nowrap mb-1">{{ $jumlah_barang }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title">

                    <span class="badge rounded-pill bg-label-success"><i class='bx bxl-dropbox'></i></span>
                    <span>Jumlah Barang Masuk</span>


                </div>
                <h3 class="card-title mb-2">{{ $jumlah_masuk }}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-12 col-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title">

                    <span class="badge rounded-pill bg-label-danger"><i class='bx bxs-truck'></i></span>
                    <span>Jumlah Barang Keluar</span>

                </div>
                <h3 class="card-title text-nowrap mb-2">{{ $jumlah_keluar }}</h3>
            </div>
        </div>
    </div>

</div>






@endif

<!-- chart -->

<div class="card shadow mb-4 col-12">
    <div class="card-header py-3">
        <h4 class="text-center">Laporan Barang <span class="badge bg-label-success">Masuk</span> Per Bulan</h4>

    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="myBarChart"></canvas>
        </div>
    </div>
</div>
<div class="card shadow mb-4 col-12">
    <div class="card-header py-3">
        <h4 class="text-center">Laporan Barang <span class="badge bg-label-danger">Keluar</span> Per Bulan</h4>

    </div>
    <div class="card-body">
        <div class="chart-bar">
            <canvas id="chartkeluar"></canvas>

        </div>
    </div>
</div>





@endsection
