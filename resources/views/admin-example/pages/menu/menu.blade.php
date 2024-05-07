@extends('admin.layouts.master')

@section('content')
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Dashboard</h1>

            <!-- Produk Makanan Section -->
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">ID</th>
                                    <th class="cell">Nama Produk</th>
                                    <th class="cell">Kategori</th>
                                    <th class="cell">Harga</th>
                                    <th class="cell">Stok</th>
                                    <th class="cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Anda dapat loop produk makanan di sini menggunakan @foreach --}}
                                {{-- Contoh: --}}
                                {{-- @foreach ($produkMakanan as $produk) --}}
                                {{-- <tr>
                                    <td class="cell">{{ $produk->id }}</td>
                                    <td class="cell">{{ $produk->nama }}</td>
                                    <td class="cell">{{ $produk->kategori }}</td>
                                    <td class="cell">{{ $produk->harga }}</td>
                                    <td class="cell">{{ $produk->stok }}</td>
                                    <td class="cell">
                                        <a class="btn btn-sm btn-primary" href="#">Edit</a>
                                        <a class="btn btn-sm btn-danger" href="#">Hapus</a>
                                    </td>
                                </tr> --}}
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->
                </div><!--//app-card-body-->
            </div><!--//app-card-->

        </div><!--//container-fluid-->
    </div><!--//app-content-->

</div><!--//app-wrapper-->
@endsection
