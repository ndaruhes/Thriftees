@extends('layouts.app')
@section('title', 'Pesanan - Thriftees')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success"><i class="uil uil-check ms-1"></i>
                    {{ session('status') }}
                </div>
            @endif

            <h1 class="fs-3 mb-5"><i class="uil uil-history me-1"></i> KELOLA PESANAN</h1>
            @if ($customerOrder->count() == null)
                @if ($ownerOrder->count() == null)
                    <div class="alert alert-warning" role="alert">
                        Belum ada pesanan
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Alamat Pengiriman</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ownerOrder as $order)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>
                                        {{ $order->barang->nama_barang }}
                                        <br>
                                        <span
                                            class="badge bg-light text-dark">{{ $order->barang->kategori->nama_kategori }}</span>
                                    </td>
                                    <td>
                                        {{ $order->alamat }}
                                        <br>
                                        <span class="badge bg-dark">Kode Pos {{ $order->kode_pos }}</span>
                                    </td>
                                    <td>
                                        <b>INV</b>{{ $order->nomor_invoice }}
                                        <br>
                                        <span
                                            class="badge @if ($order->status == 'Pending') bg-warning text-dark @else bg-success @endif">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->jumlah_pesanan }}</td>
                                    <td>Rp{{ number_format($order->barang->harga_barang) }}</td>
                                    <td><b>Rp{{ number_format($order->total_harga) }}</b></td>
                                    <td>
                                        @if ($order->status == 'Pending')
                                            <a href="#" data-uri="{{ route('terimaPesanan', $order->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#konfirmasiTerimaPesananModal"
                                                class="btn btn-success btn-sm fs-6 fw-bold text-white">
                                                Terima<i class="uil uil-check-circle ms-1"></i>
                                            </a>
                                        @else
                                            <a href="#"
                                                class="btn btn-secondary btn-sm fs-6 fw-bold text-white cursor-disabled">
                                                Sudah Diterima 😊
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                @if ($customerOrder->count() == null)
                    <div class="alert alert-warning" role="alert">
                        Belum ada pesanan
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Alamat Pengiriman</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customerOrder as $order)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>
                                        {{ $order->barang->nama_barang }}
                                        <br>
                                        <span
                                            class="badge bg-light text-dark">{{ $order->barang->kategori->nama_kategori }}</span>
                                    </td>
                                    <td>
                                        {{ $order->alamat }}
                                        <br>
                                        <span class="badge bg-dark">Kode Pos {{ $order->kode_pos }}</span>
                                    </td>
                                    <td>
                                        <b>INV</b>{{ $order->nomor_invoice }}
                                        <br>
                                        <span
                                            class="badge @if ($order->status == 'Pending') bg-warning text-dark @else bg-success @endif">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->jumlah_pesanan }}</td>
                                    <td>Rp{{ number_format($order->barang->harga_barang) }}</td>
                                    <td><b>Rp{{ number_format($order->total_harga) }}</b></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
    </div>
@endsection
