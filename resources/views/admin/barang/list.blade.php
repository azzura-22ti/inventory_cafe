@extends('layouts.layout')

@section('content')
<h4 class="py-3 mb-4"><span class="fw-bold">Data barang</h4>

<!-- Tabel -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalCreate"><i class='bx bx-plus'></i> Tambah</a>
        <h3 class="fw-semibold">List Barang</h3>
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

                    @foreach ($data_barang as $du)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            <span class="fw-medium">{{ $du->nama_barang }}</span>
                        </td>
                        <td><span class="badge bg-label-primary me-1">{{ $du->nama_kategori }}</span></td>
                        <td>{{ $du->stok }}</td>
                        <td>{{ $du->satuan }}</td>
                        <td>Rp. {{ number_format($du->harga) }}</td>
                        <td>
                            <a href="#modalEdit{{ $du->id }}" data-bs-toggle="modal" class="btn btn-warning"><i class='bx bx-edit'></i></a>
                            <a href="#modalHapus{{ $du->id }}" data-bs-toggle="modal" class="btn btn-danger"><i class='bx bx-trash'></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Tabel -->


<!-- Modal -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Form Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/barang/store" method="POST">
                        @csrf

                        <input type="hidden" name="stok" value="0" required />

                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama Barang</label>
                            <input type="text" id="nameWithTitle" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Kategori</label>
                            <input type="text" id="nameWithTitle" name="nama_kategori" class="form-control" placeholder="Masukkan kategori barang" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Satuan</label>
                            <input type="text" id="nameWithTitle" name="satuan" class="form-control" placeholder="Cth: Kg/Pcs/Box" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Harga</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>

                                <input type="number" id="nameWithTitle" name="harga" class="form-control" placeholder="Masukkan harga" required />
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

@foreach ($data_barang as $d)
<div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Form Edit Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/barang/update/{{ $d->id }}" method="POST">
                        @csrf

                        <input type="hidden" name="stok" value="{{ $d->stok }}" />

                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama Barang</label>
                            <input type="text" id="nameWithTitle" value="{{ $d->nama_barang }}" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Kategori</label>
                            <input type="text" id="nameWithTitle" value="{{ $d->nama_kategori }}" name="nama_kategori" class="form-control" placeholder="Masukkan kategori barang" />
                        </div>

                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Satuan</label>
                            <input type="text" id="nameWithTitle" value="{{ $d->satuan }}" name="satuan" class="form-control" placeholder="Cth: Kg/Pcs/Box" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Harga</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp. </span>
                                </div>

                                <input type="number" id="nameWithTitle" value="{{ $d->harga }}" name="harga" class="form-control" placeholder="Masukkan harga" required />
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($data_barang as $dus)
<div class="modal fade" id="modalHapus{{ $dus->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Form Hapus Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/barang/destroy/{{ $dus->id }}" method="GET">
                        @csrf

                        <div class="col mb-3">
                            <h4>Apakah ingin menghapus data ini?</h4>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class='bx bx-arrow-back'></i> Kembali</button>
                <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i> Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
