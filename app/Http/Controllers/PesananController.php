<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('allBarang');
        } else {
            $pesanan = Pesanan::get();
            $pesananPending = Pesanan::where('status', '=', 'Pending')->get();
            return view('pesanan.index', compact('pesanan', 'pesananPending'));
        }
    }

    public function pesan(Request $request)
    {
        $idBarang = Str::substr(str_replace(url('/'), '', url()->previous()), 8);
        $request->validate([
            'jumlah_pesanan' => 'required|integer',
            'alamat' => 'required|string|min:10|max:100',
            'kode_pos' => 'required|integer|digits:5',
        ]);

        $barang = Barang::findOrFail($idBarang);
        $totalHarga = $request->jumlah_pesanan * $barang->harga_barang;

        if ($request->jumlah_pesanan > $barang->jumlah_barang) {
            return redirect()->route('showBarang', $idBarang)->with('errorStatus', 'Stok yang tersisa hanya ' . $barang->jumlah_barang);
        }

        Pesanan::create([
            'id_barang' => $idBarang,
            'id_user' => Auth::user()->id,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'total_harga' => $totalHarga,
            'nomor_invoice' => rand(),
            'status' => 'Pending'
        ]);

        $sisaStok = $barang->jumlah_barang - $request->jumlah_pesanan;
        $barang->update([
            'jumlah_barang' => $sisaStok
        ]);

        return redirect()->route('indexPesanan')->with('status', 'Pesanan berhasil dibuat, mohon tunggu konfirmasi');
    }

    public function accept($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update([
            'status' => 'Accepted'
        ]);

        return redirect()->route('indexPesanan')->with('status', 'Pesanan berhasil diterima');
    }
}
