@extends('layout.main')

@section('title', ' - Penjualan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h4 class="position-absolute text-primary">Data Penjualan</h4>
                        <div class="card-header-form float-right">
                            {{-- <form action="/kasir/penjualan" method="GET" class="form-inline">
                                <input type="text" name="search" class="form-control mr-2" placeholder="Cari data transaksi...">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                            </form>      --}}
                            <a href="{{ url('/kasir/penjualan/form') }}" class="btn btn-sm btn-outline-success">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                            <a href="{{ url('/penjualan/export-pdf') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-file-pdf"></i> Export PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Total</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi as $transaksi)
                                <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional ($transaksi->pelanggan)->nama_pelanggan }}</td>
                                        <td>{{ $transaksi->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $transaksi->total }}</td>
                                        <td>{{auth()->user()->name}}</td>
                                        <td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Actions">
                                                    <a href="{{ route('penjualan.detail', $transaksi->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <i class="fa fa-eye"></i> Lihat Bukti
                                                    </a>
                                                    <a href="{{ url('/penjualan/export-pdf') }}"
                                                        class="btn btn-sm btn-outline-info"><i class="fa fa-download"></i>
                                                        Unduh</a>
                                                        <form action="/{{auth()->user()->role}}/penjualan/{{$transaksi->id}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                                                <i class="fa fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    {{-- @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                         data-id="{{$produk->id}}"
                                                         onclick="confirmDelete(this)"><i class="fa fa-trash"></i> Delete</a> --}}
                                                </form>
                                            </td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('penjualan.showDetails');
</section>
@endsection
