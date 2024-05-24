@extends('layout.main')

@section('title', ' - Edit')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Produk</h1>
    </div>

    <div class="section-body">
        <div class="card shadow">
            <div class="card-header bg-white">
                <h4>Edit Data Produk</h4>
            </div>
            <div class="card-body">
                <form action="/{{auth()->user()->role}}/produk/{{$data->id}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama_produk" value="{{$data->nama_produk}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control jumlah" id="harga" name="harga"
                                        value="{{$data->harga}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="image">Add Image</label>
                                    <input type="file" class="form-control fs-5" id="image" name="image"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control jumlah" name="stock" required readonly value="{{$data->stock}}">
                            </div>
                        </div>
                    </div>
                    <a href="/{{auth()->user()->role}}/produk" class="btn btn-sm btn-outline-warning"><i class="fas fa-caret-left"></i>
                        Kembali</a>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i>
                        Edit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
