@extends('layouts.layout')

@section('content')
<h4 class="py-3 mb-4"><span class="fw-bold">Laporan Barang Masuk</h4>

<!-- Tabel -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" class="btn btn-danger float-end" data-bs-toggle="modal" data-bs-target="#modalCreate"><i class='menu-icon tf-icons bx bxs-file-pdf'></i> Cetak</a>
        <h3 class="fw-semibold">List Barang Masuk</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah Masuk</th>
                        <th>Satuan</th>
                        <th>Total Harga</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang_masuk as $du)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="fw-medium">{{ $du->nama_barang }}</span>
                        </td>
                        <td><span class="badge bg-label-primary me-1">{{ $du->nama_kategori }}</span></td>
                        <td>{{ $du->jumlah_masuk }}</td>
                        <td>{{ $du->satuan }}</td>
                        <td>Rp. {{ number_format($du->harga * $du->jumlah_masuk) }}</td>
                        <td>{{ $du->tanggal_masuk }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Tabel -->

<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Cetak Laporan Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/barang/store" method="POST">
                        @csrf

                        <input type="hidden" name="stok" value="0" required />

                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Tanggal Awal</label>
                            <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" required />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Tanggal Akhir</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" required />
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary" onclick="this.href='/cetak_masuk/' + document.getElementById('tanggal_awal').value + '/' + document.getElementById('tanggal_akhir').value" target="_blank"><i class='menu-icon tf-icons bx bx-printer'></i> Cetak</a>


            </div>
            </form>
        </div>
    </div>
</div>


@endsection
