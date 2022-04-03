@extends('layouts.app')
@section('title', 'Eksplor | Thriftees')

@section('content')
    @include('layouts.jumbotron')

    <div class="container mt-3">
        @if ($barang->count() == null)
            <div class="alert alert-warning" role="alert">
                Barang masih kosong
            </div>
        @else
            <div class="row">
                @foreach ($barang as $data)
                    <div class="col-xl-3 col-6 item">
                        <div class="col-md-12 item-content">
                            <div class="image"
                                style="background-image: url({{ asset('storage/images/barang/' . $data->foto_barang) }});">
                            </div>
                            <div class="text">
                                <h5 class="title">{{ $data->nama_barang }}</h5>
                                <p class="price">Rp{{ number_format($data->harga_barang) }}</p>
                                <p class="stock text-muted">
                                    Stok:
                                    @if ($data->jumlah_barang === '0' || $data->jumlah_barang == null)
                                        <span class="text-danger">Habis</span>
                                    @else
                                        {{ $data->jumlah_barang }}
                                    @endif
                                </p>
                                <a href="{{ route('showBarang', $data->id) }}" class="btn bg-green w-100">Lihat
                                    Produk <i class="uil uil-eye ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
