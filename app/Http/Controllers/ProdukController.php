<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil nilai pencarian dari request
        // Lakukan query pencarian dan paginasi
        $produks = Produk::where('nama_produk', 'like', "%$search%")
        ->orWhere('harga', 'like', "%$search%")
        ->paginate(10);

        // Kirim data hasil pencarian ke view
        return view('produk.index', compact('produks', 'search'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric|min:0', 
            'stock' => 'required|integer|min:0',
        ]);
        //tambah data ke database
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = time() . rand() . '.' . $image->getClientOriginalExtension();
    
            $destinationPath = public_path('/images/photo');
            $image->move($destinationPath, $imgName);
            $uploaded = $imgName;
            $request->session()->flash('uploaded_photo', $imgName);
        } 
        
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'image' => $uploaded,
            'harga' => $request->harga,
            'stock' => $request->stock,
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect('/admin/produk')->with('successAdd','Berhasil menambahkan produk!');
    }

    public function edit($id)
    {
        $data = Produk::where('id', $id)->first();
        // lalu tampilkan halaman dari view edit dengan mengirim data yang ada di variable todo
        return view('produk.edit', compact('data'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required',
        'harga' => 'required|numeric|min:0', 
    ]);

    $produk = Produk::findOrFail($id);
    
    $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imgName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/photo');
        $image->store('photo', 'public'); // Ubah ini sesuai kebutuhan
        if ($produk->image) {
            unlink(public_path('images/photo/' . $produk->image));
        }
        $produk->update([
            'image' => $imgName
        ]);
    }
    

    //redirect if successful along with alert
    return redirect('/admin/produk')->with('successAdd','Berhasil mengupdate data!');
}


    public function editStock($id)
    {
        $produk =  Produk::where('id', $id)->first();
        // lalu tampilkan halaman dari view edit dengan mengirim data yang ada di variable todo
        return view('produk.stock', compact('produk'));
    }

    public function stock(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'stock' => 'required', 
        ]);
        //tambah data ke database

        Produk::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'stock' => $request->stock,
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect('/admin/produk')->with('successAdd','Berhasil mengupdate data!');
    }

    public function delete($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'User not found.');
        }
        
        $produk->delete();

        return redirect()->route('/admin/produk')->with('success', 'User deleted successfully.');
    }


}
