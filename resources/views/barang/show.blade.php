@extends('layouts.app')
@section('addedCSS')
    <link href="{{ asset('css/detailBarang.css') }}" rel="stylesheet">
@endsection

@section('title', $barang->nama_barang . ' - Thriftees')

@section('content')
    <div class="col-md-12 d-flex justify-content-center mt-3">
        <div class="col-md-5">
            @if (session('errorStatus'))
                <div class="alert alert-danger"><i class="uil uil-times me-2"></i>{{ session('errorStatus') }}</div>
            @endif
            <div class="image"
                style="background-image: url({{ asset('storage/images/barang/' . $barang->foto_barang) }});">
            </div>
            <span class="badge category bg-pink">{{ $barang->kategori->nama_kategori }}</span>
            <h1 class="title">{{ $barang->nama_barang }}</h1>
            <h1 class="price">Rp{{ number_format($barang->harga_barang) }}</h1>
            <h1 class="stock text-muted">
                Sisa Stok:
                @if ($barang->jumlah_barang === '0' || $barang->jumlah_barang == null)
                    <span class="text-danger">Habis</span>
                @else
                    {{ $barang->jumlah_barang }}
                @endif
            </h1>
            <h1 class="description">{!! $barang->deskripsi_barang !!}</h1>

            @guest
                <a href="{{ route('login') }}" class="btn bg-green btn-book">Pesan Sekarang</a>
            @else
                @if (Auth::user()->role == 'Member')
                    <a href="#" class="btn bg-green btn-book" data-bs-toggle="modal" data-bs-target="#pesanBarangModal">Pesan
                        Sekarang</a>

                    <div class="modal fade" id="pesanBarangModal" tabindex="-1" aria-labelledby="pesanBarangModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pesanBarangModalLabel">Pesan Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pesanBarang') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Jumlah Pesanan</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="uil uil-shopping-cart"></i></span>
                                                <input type="number" class="form-control" placeholder="Mau pesan berapa"
                                                    name="jumlah_pesanan">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kode Pos</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="uil uil-sign-right"></i></span>
                                                <input type="number" class="form-control" placeholder="Masukkan Kode POS"
                                                    name="kode_pos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Masukkan Alamat</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="uil uil-truck"></i></span>
                                                <textarea class="form-control" placeholder="Ketik alamat disini" name="alamat"></textarea>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm text-white">Pesan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endguest
        </div>
    </div>
@endsection
