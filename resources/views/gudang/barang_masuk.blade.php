@extends('layouts.layout')

@section('content')
<h4 class="py-3 mb-4"><span class="fw-bold">Barang Masuk</h4>

<!-- Tabel -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="fw-semibold">Barang Tersedia</h3>
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
                        <th>Total Harga</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp

                    @foreach ($data_barang as $b)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>{{ $b->nama_kategori }}</td>
                        <td>{{ $b->stok }}</td>
                        <td>{{ $b->satuan }}</td>
                        <td>Rp. {{ number_format($b->harga * $b->stok) }}</td>

                        <td>
                            <a href="#modalCreate{{ $b->id }}" data-bs-toggle="modal" class="btn btn-primary"><i class='menu-icon tf-icons bx bx-plus'></i> Tambah</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Tabel -->

@foreach ($data_barang as $ba)
<!-- Modal -->
<div class="modal fade" id="modalCreate{{ $ba->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Form Tambah Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/barang_masuk/store/{{ $ba->id }}" method="POST">

                        @csrf
                        <input type="hidden" value="{{ $ba->id_barang }}">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama</label>
                            <input type="text" id="nameWithTitle" value="{{ $ba->nama_barang }}" name="nama_barang" class="form-control" placeholder="Masukkan nama" readonly />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Kategori</label>
                            <input type="text" id="nameWithTitle" value="{{ $ba->nama_kategori }}" name="nama_kategori" class="form-control" placeholder="Masukkan nama" readonly />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Stok Sekarang</label>
                            <input type="number" id="nameWithTitle" value="{{ $ba->stok }}" name="stok" class="form-control" placeholder="Jumlah Stok" readonly />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Tambah Stok</label>
                            <input type="number" id="nameWithTitle" name="jumlah_masuk" class="form-control" placeholder="Jumlah Stok" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Satuan Barang</label>
                            <input type="text" id="nameWithTitle" value="{{ $ba->satuan }}" name="satuan" class="form-control" placeholder="Masukkan nama" readonly />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Tanggal Masuk</label>
                            <input type="date" id="nameWithTitle" name="tanggal_masuk" class="form-control" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Harga</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>

                                <input type="number" id="nameWithTitle" value="{{ $ba->harga }}" name="harga" class="form-control" placeholder="Masukkan harga" required readonly />
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
