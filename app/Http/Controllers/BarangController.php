<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::where('id_owner', Auth::user()->id)->get();
        $kategori = Kategori::get();
        return view('barang.index', compact('barang', 'kategori'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        if($barang->id_owner != Auth::user()->id) {
            return redirect()->route('allBarang');
        }
        $kategori = Kategori::get();
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'min:5|max:80|required|string',
            'harga_barang' => 'integer|required',
            'stok' => 'integer|required',
            'deskripsi_barang' => 'string|required|min:10',
            'kategori' => 'required',
            'foto_barang' => 'required'
        ]);

        $files = $request->file('foto_barang');
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $Image = $fileName . "-" . Str::random(10) . "-" . date('YmdHis') . "." . $extension;
        $files->storeAs('public/images/barang', $Image);

        DB::table('barang')->insert([
            'foto_barang' => $Image,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->stok,
            'deskripsi_barang' => $request->deskripsi_barang,
            'user_id' => Auth::user()->id,
            'kategori_id' => $request->kategori,
        ]);

        return redirect()->route('indexBarang')->with('status', 'Barang berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        if ($request->file('foto_barang') == null) {
            $request->validate([
                'nama_barang' => 'min:5|max:80|required|string',
                'harga_barang' => 'integer|required',
                'stok' => 'integer|required',
                'deskripsi_barang' => 'string|required|min:10',
                'kategori' => 'required'
            ]);
            $barang = Barang::findOrFail($id);
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'jumlah_barang' => $request->stok,
                'deskripsi_barang' => $request->deskripsi_barang,
                'kategori_id' => $request->kategori,
            ]);

            return redirect()->route('indexBarang')->with('status', 'Barang berhasil diubah');
        } else {
            $request->validate([
                'nama_barang' => 'min:5|max:80|required|string',
                'harga_barang' => 'integer|required',
                'stok' => 'integer|required',
                'deskripsi_barang' => 'string|required|min:10',
                'kategori' => 'required',
                'foto_barang' => 'required'
            ]);

            $files = $request->file('foto_barang');
            $fullFileName = $files->getClientOriginalName();
            $fileName = pathinfo($fullFileName)['filename'];
            $extension = $files->getClientOriginalExtension();
            $Image = $fileName . "-" . Str::random(10) . "-" . date('YmdHis') . "." . $extension;
            $files->storeAs('public/images/barang', $Image);

            $barang = Barang::findOrFail($id);
            if (Storage::exists('public/images/barang/' . $barang->foto_barang)) {
                Storage::delete('public/images/barang/' . $barang->foto_barang);
            }
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'jumlah_barang' => $request->stok,
                'deskripsi_barang' => $request->deskripsi_barang,
                'kategori_id' => $request->kategori,
                'foto_barang' => $Image
            ]);

            return redirect()->route('indexBarang')->with('status', 'Barang berhasil diubah');
        }
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if (Storage::exists('public/images/barang/' . $barang->foto_barang)) {
            Storage::delete('public/images/barang/' . $barang->foto_barang);
        }
        $barang->delete();

        return redirect()->route('indexBarang')->with('status', 'Barang berhasil dihapus');
    }
}
