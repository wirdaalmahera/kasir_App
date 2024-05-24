@extends('layout.main')

@section('title', ' - Pelanggan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="text-primary">Penjualan</h4>
            </div>
            <div class="card-body">
                <div method="GET">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">ID Produk</label>
                        </div>
                        <div class="col-md-5">
                            <div class="d-flex">
                                <select  class="form-control" id="produk_id">
                                    <option value="">-- {{isset($data) ? $data->nama_produk : ''}} --</option>
                                    @foreach ($produk as $item)
                                        <option value="{{$item}}">{{$item->id}}.{{$item->nama_produk}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">ID Pelanggan</label>
                        </div>
                        <div class="col-md-5">
                            <div class="d-flex">
                                <select name="pelanggan_id" class="form-control" id="pelanggan_id">
                                    <option value="">-- {{isset($dt) ? $dt->nama_pelanggan : ''}} --</option>
                                    @foreach ($pelanggan as $item)
                                       <option value="{{$item->id}}">{{$item->id}}.{{$item->nama_pelanggan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                                <button type="submit" class="btn btn-primary ml-2" onclick="addProduct()">Pilih</button>
                        </div>
                        {{-- <div class="col-md-8">
                            <a href="/kasir/penjualan" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pembelian</a>
                        </div> --}}
                    </div>
                </div>

                <br>
{{-- 
<div class="row mt-2">
    <div class="col-md-4">
        <label for="">Jumlah Produk Kedua</label>
    </div>
    <div class="col-md-5">
        <div class="d-flex">
            <input type="number" class="form-control" name="jumlah_produk2" value="{{ old('jumlah_produk2') }}">
        </div>
    </div>
</div> --}}


                

                <br>
                <br>

                <form action="/kasir/penjualan" method="post">
                @csrf

                    
                     
                <div id="item">

                </div>
                <input  name="pelanggan_id" id="pela" hidden/>
                <input id="total" name="total" hidden/>

                <div class="row mt-2">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <h5>Subtotal: Rp. <span id="totalHarga"></span> </h5>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">
                        <a href="/kasir/penjualan" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
<script>
    let products = [];
    let el = 0
    let subtotal = 0;

    function addProduct(){
        let value = JSON.parse(document.getElementById('produk_id').value);
        products.push(value)
        document.getElementById('pela').value = document.getElementById('pelanggan_id').value
        let str = `
        <h5>Produk Ke - ${products.length}</h1>
        <div class="item">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label for="">Nama Produk</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" value="${value.nama_produk}" disabled class="form-control" id="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label for="">Stock</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" value="${value.stock}" disabled class="form-control" id="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label for="">Harga</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" value="${value.harga}" disabled class="form-control"  id="">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label for="">Jumlah</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex">
                                        <input onChange="changeTotal(${products.length-1},${value.price})" type="number"  id="jumlah${products.length}" class="form-control" name="jumlah[]">
                                    </div>
                                </div>
                            </div>
                            <input id="produk_ids" name="produk_ids[]" value=${value.id} hidden/>
                        </div>`
       let body =  document.getElementById("item");
       let container = document.createElement("div")
       container.innerHTML = str;
        body.appendChild(container)
        document.getElementById('produk_id').value = null
    }
    function changeTotal(index,price){
        let qty = document.getElementById("jumlah"+products.length).value
        let total = products[index].harga * qty
        subtotal = subtotal + total;
        document.getElementById("totalHarga").innerHTML = subtotal
        document.getElementById("total").value = subtotal
    }
</script>
@endsection
