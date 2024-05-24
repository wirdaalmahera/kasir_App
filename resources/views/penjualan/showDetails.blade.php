@extends('layout.main')

@section('title', ' - Detail Penjualan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Transaksi</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">ID Transaksi</th>
                                <td>{{ $transaksi->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <td>{{ optional($transaksi->pelanggan)->nama_pelanggan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Penjualan</th>
                                <td>{{ $transaksi->created_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>Rp {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                            </tr>
                            <!-- Add more details here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ url('/kasir/penjualan') }}" class="btn btn-outline-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
</section>
@endsection
