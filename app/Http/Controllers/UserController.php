<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function user(Request $request)
    {
        $user = User::all();
        $search = $request->input('search'); // Ambil nilai pencarian dari request
        // Lakukan query pencarian dan paginasi
        $user = User::where('name', 'like', "%$search%")
        ->orWhere('role', 'like', "%$search%")
        ->paginate(10);
        return view('user.user', compact('user','search'));
    }

    public function store(Request $request)
    {
        try{
            $now = Carbon::now();
            $tahun_bulan = $now->year . $now->month;
            $cek = User::count();
            
            if($cek == 0){
                $urut = 100001;
                $kode = 'K-' . $tahun_bulan . $urut;
            }else {
                $ambil = User::all()->last();
                $urut = (int)substr($ambil->kode, -6) + 1;
                $kode = 'K-' . $tahun_bulan . $urut;
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'role' => 'required|string',
            ]);
    
            $user = new User;
            // $user->kode = $kode;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->save();
    
    
            return redirect('/admin/user')->with('sukses', 'Berhasil Daftar, Silahkan Login!');
        }catch(\Exception $e){
            return redirect('/admin/user')->with('status', 'Tidak Berhasil Daftar. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        // lalu tampilkan halaman dari view edit dengan mengirim data yang ada di variable todo
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([    
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string', // password dapat kosong atau tidak diisi
            'role' => 'required|string',
        ]);
        
        // Temukan data pengguna yang ingin diperbarui
        $user = User::findOrFail($id);
    
        // Perbarui atribut-atributnya satu per satu
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        
        // Simpan perubahan
        $user->save();
        
        // Redirect setelah berhasil dengan pesan sukses
        return redirect('/admin/user')->with('successAdd','Berhasil mengupdate data!');
    }
    

    // public function delete($id)
    // {
    //     $user = User::find($id);
    //     $user->delete();

    //     return redirect('/admin/user')->with('sukses', 'Data Berhasil Di Hapus');
    // }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        
        $user->delete();

        return redirect()->route('/admin/user')->with('success', 'User deleted successfully.');
    }
}
