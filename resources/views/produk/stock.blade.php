@extends('layout.main')

@section('title', ' - EditStock')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Stock</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="text-primary">Edit Stock</h4>
            </div>
            <div class="card-body">
                <form action="/{{auth()->user()->role}}/stock/{{$produk->id}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk" readonly value="{{$produk->nama_produk}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" class="form-control jumlah" name="stock" value="{{$produk->stock}}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary float-right">Update Stock</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
