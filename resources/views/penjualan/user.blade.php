@extends('layout.main')

@section('title', ' - Pelanggan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pelanggan</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="text-primary">Pelanggan</h4>
            </div>
            <div class="card-body">
                <form action="/kasir/penjualan/pelanggan" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">ID</label>
                                <input type="text" name="pelanggan_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" name="alamat" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telp</label>
                                <input type="number" name="no_telp" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <a href="/{{auth()->user()->role}}/user" class="btn btn-sm btn-outline-warning"><i class="fas fa-caret-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Tambah</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
