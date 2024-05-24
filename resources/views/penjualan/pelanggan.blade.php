@extends('layout.main')

@section('title', ' - Pelanggan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pelanggan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white">
                        <h4 class="position-absolute text-primary">Data Penjualan</h4>
                        <div class="card-header-form float-right">
                            <a href="/kasir/penjualan/pelanggan/user" class="btn btn-sm btn-outline-success">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </div> 
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 20%">Nama</th>
                                    <th style="width: 20%">Alamat</th>
                                    <th style="width: 10%">No Telphone</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_pelanggan}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{$item->no_telp}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="/kasir/penjualan/pelanggan/{{ $item->id }}/edit" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i> Edit</a>
                                            <form action="/kasir/penjualan/pelanggan/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i> Delete</button>
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
</section>
{{-- @include('user.form'); --}}
@endsection
{{-- 
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

    var data_anggota = $(this).attr('data-id')
    function confirmDelete(button) {
    
        event.preventDefault()
        const id = button.getAttribute('data-id');
        const kode = button.getAttribute('id');
        swal({
                title: 'Apa Anda Yakin ?',
                text: 'Anda akan menghapus data: "' + kode + '". Ketika Anda tekan OK, maka data tidak dapat dikembalikan !',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
        .then((willDelete) => {
            if (willDelete) {
              const form = document.getElementById('delete-form');
              // Setelah pengguna mengkonfirmasi penghapusan, Anda bisa mengirim form ke server
              form.action = '/{{auth()->user()->level}}/user/' + id; // Ubah aksi form sesuai dengan ID yang sesuai
              form.submit();
            }
        });
    }

    // Ambil referensi ke elemen input password
    const passwordInput = document.getElementById('password');

    // Tambahkan event listener untuk memeriksa input setiap kali pengguna mengetik
    passwordInput.addEventListener('input', function() {
        // Ambil nilai password dari input
        const password = passwordInput.value;

        // Periksa panjang password
        const isLengthValid = password.length >= 8;

        // Periksa apakah setidaknya satu huruf kapital ada di dalam password
        const hasCapitalLetter = /[A-Z]/.test(password);

        // Jika panjang password tidak mencukupi atau tidak memiliki huruf kapital
        if (!isLengthValid || !hasCapitalLetter) {
            // Tampilkan pesan kesalahan
            document.getElementById('warning-message').style.display = 'block';
        } else {
            // Hapus pesan kesalahan jika password valid
            document.getElementById('warning-message').style.display = 'none';
        }
    });

    function validasiInput(inputElement) {
      // Membuang karakter angka dari nilai input
      inputElement.value = inputElement.value.replace(/[^a-zA-Z]/g, '');
    }
</script>
@endpush --}}
