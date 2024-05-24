@extends('layout.main')

@section('title', ' - Produk')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Produk</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">Produk</h4>
                        <form action="{{ route('produk.index') }}" method="GET" class="form-inline">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Cari data produk...">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                        </form>                        
                        <div class="card-header-form">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#form-tambah">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>                              
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th style="width: 20%">Nama Product</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produks as $produk)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$produk->nama_produk}}</td>
                                        <td>{{$produk->formatRupiah('harga')}}</td>
                                        <td>
                                            <img src ="{{asset('images/photo/' . $produk->image)}}" alt="" width="80px" srcset="">
                                        </td>
                                        @if($produk->stock <= 0)
                                        <td><span class="text-danger">Stok Habis</span></td>
                                        @endif
                                        @if($produk->stock > 0)
                                        <td>{{$produk->stock}}</td>
                                        @endif
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <a href="/{{auth()->user()->role}}/produk/{{$produk->id}}/edit"
                                                    class="btn btn-sm btn-outline-warning" ata-toggle="modal"
                                                    data-target="#form-edit"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="/{{auth()->user()->role}}/stock/{{$produk->id}}/edit"
                                                    class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i>
                                                    Update Stock</a>
                                                <form action="/{{auth()->user()->role}}/produk/{{$produk->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i> Delete</button>
                                                </form>
                                                {{-- @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                     data-id="{{$produk->id}}"
                                                     onclick="confirmDelete(this)"><i class="fa fa-trash"></i> Delete</a> --}}
                                            </form>
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
    </div>
</section>
@include('produk.form');
@endsection


@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

    $(document).ready(function () {
        $('.jumlah').on('input', function () {
            if ($(this).val() < 0) {
                $(this).val(0);
            }
        });
    })

    // Mengambil elemen input
    var harga_beli = document.getElementById('harga-beli');
    var harga_jual = document.getElementById('harga-jual');
    var diskon = document.getElementById('diskon');

    // Menambahkan event listener untuk setiap kali ada input
    harga_beli.addEventListener('input', function() {
      // Mengganti nilai input hanya dengan karakter angka
      this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Menambahkan event listener untuk setiap kali ada input
    harga_jual.addEventListener('input', function() {
      // Mengganti nilai input hanya dengan karakter angka
      this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Menambahkan event listener untuk setiap kali ada input
    diskon.addEventListener('input', function() {
      // Mengganti nilai input hanya dengan karakter angka
      this.value = this.value.replace(/[^0-9]/g, '');
    });

    var data_anggota = $(this).attr('data-id')

    function confirmDelete(button) {

        event.preventDefault()
        const id = button.getAttribute('data-id');
        const kode = button.getAttribute('id');
        swal({
                title: 'Apa Anda Yakin ?',
                text: 'Anda akan menghapus data: "' + kode +
                    '". Ketika Anda tekan OK, maka data tidak dapat dikembalikan !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    const form = document.getElementById('delete-form');
                    // Setelah pengguna mengkonfirmasi penghapusan, Anda bisa mengirim form ke server
                    form.action = '/{{auth()->user()->level}}/barang/' + id; // Ubah aksi form sesuai dengan ID yang sesuai
                    form.submit();
                }
            });
    }

</script>
@endpush
