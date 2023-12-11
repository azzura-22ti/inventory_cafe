@extends('layouts.layout')

@section('content')
<h4 class="py-3 mb-4"><span class="fw-bold">Data User</h4>

<!-- Tabel -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalCreate"><i class='menu-icon tf-icons bx bx-plus'></i> Tambah</a>
        <h3 class="fw-semibold">List User</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp

                    @foreach ($data_user as $du)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            <span class="fw-medium">{{ $du->nama }}</span>
                        </td>
                        <td>{{ $du->email }}</td>
                        <td><span class="badge bg-label-primary me-1">{{ $du->level }}</span></td>
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
                <h5 class="modal-title" id="modalCenterTitle">Form Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/user/store" method="POST">
                        @csrf

                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama</label>
                            <input type="text" id="nameWithTitle" name="nama" class="form-control" placeholder="Masukkan nama" />
                        </div>
                </div>
                <div class="row g-3">
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Email</label>
                        <input type="email" name="email" id="emailWithTitle" class="form-control" placeholder="blabla@gmail.com" />
                    </div>
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Password</label>
                        <input type="password" name="password" id="emailWithTitle" class="form-control" placeholder="*******" />
                    </div>
                    <div class="col mb-0">
                        <label for="dobWithTitle" class="form-label">Level</label>
                        <select class="form-control" name="level" required>
                            <option value="" hidden>Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="gudang">Gudang</option>
                        </select>
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

@foreach ($data_user as $d)
<div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Form Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/user/update/{{ $d->id }}" method="POST">
                        @csrf

                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Nama</label>
                            <input type="text" id="nameWithTitle" value="{{ $d->nama }}" name="nama" class="form-control" placeholder="Masukkan nama" />
                        </div>
                </div>
                <div class="row g-3">
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Email</label>
                        <input type="email" value="{{ $d->email }}" name="email" id="emailWithTitle" class="form-control" placeholder="blabla@gmail.com" />
                    </div>
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Password</label>
                        <input type="password" value="{{ $d->password }}" name="password" id="emailWithTitle" class="form-control" placeholder="******" />
                    </div>
                    <div class="col mb-0">
                        <label for="dobWithTitle" class="form-label">Level</label>
                        <select class="form-control" name="level" required>
                            <option <?php if ($d['level'] == 'admin') {
                                        echo 'selected';
                                    } ?> value="admin">Admin</option>
                            <option <?php if ($d['level'] == 'gudang') {
                                        echo 'selected';
                                    } ?> value="gudang">Gudang</option>
                        </select>
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

@foreach ($data_user as $dus)
<div class="modal fade" id="modalHapus{{ $dus->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Form Hapus User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/user/destroy/{{ $dus->id }}" method="GET">
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
