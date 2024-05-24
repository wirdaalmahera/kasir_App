<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('auth.register', compact('user'));
    }

    public function dashboard()
    {
        return view('dashboard.index');
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
    
    
            return redirect('/')->with('sukses', 'Berhasil Daftar, Silahkan Login!');
        }catch(\Exception $e){
            return redirect('daftar')->with('status', 'Tidak Berhasil Daftar. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request): RedirectResponse
    {
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();

            if($user->role == 'admin'){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/kasir/dashboard');
            }
        }
        else {
            return back()->with('gagal', 'Email atau Password salah!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // public function forgotPw()
    // {
    //     return view('auth.forgotPassword');
    // }
}
