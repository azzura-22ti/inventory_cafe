<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Barang Masuk</title>
    <style>
        table.static {
            position: relative;
            border: 1px;
        }

    </style>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Barang Masuk</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%">
            <thead>
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
                @foreach ($masukPertanggal as $du)
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
</body>
</html>
