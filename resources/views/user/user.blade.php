@extends('layout.main')

@section('title', ' - User')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">User</h4>
                        <form action="/admin/user" method="GET" class="form-inline">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Cari data user...">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                        </form>                        
                        <div class="card-header-form">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#form-tambah">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>        
                    <div class="card-body p-2">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 20%">Nama</th>
                                    <th style="width: 20%">Email</th>
                                    <th style="width: 10%">Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    @if($item->role == 'admin')
                                    <td><div class="badge badge-success">Admin</div></td>
                                    @elseif($item->role == 'kasir')
                                    <td><div class="badge badge-info">Kasir</div></td>
                                    @endif
                                    <td>
                                        <div class="btn-group" role="group" aria-label="User Actions">
                                            <a href="/{{auth()->user()->role}}/user/{{$item->id}}/edit" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i> Edit</a>
                                            <form action="/{{auth()->user()->role}}/user/{{$item->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
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
@include('user.form');
@endsection

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
@endpush
