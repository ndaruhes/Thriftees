<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $barang = Barang::get();
        $kategori = Kategori::get();
        return view('home', compact('barang', 'kategori'));
    }
}
