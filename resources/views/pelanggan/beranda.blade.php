@extends('layouts.pelanggan')
@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5 hero-header">
        <div class="container my-5 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-2 text-black animated slideInLeft ff-righteous">Rasa Keluarga, Harga Ramah di Hati</h1>
                    <p class="text-white animated slideInLeft mb-4 pb-2"></p>
                    <a href="#recommendedMenu" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft rounded-pill">Pesan sekarang</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl py-5 bg-gray-light" id="recommendedMenu">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">Menu Rekomendasi</h1>
            </div>
            <div class="row g-4 mb-3">
                @foreach ($recommended_menus as $menu)
                <div class="col-lg-3 col-sm-6 pointer-events-none " data-wow-delay="0.1s">
                    <div class="rounded-3">
                        <div class="card text-center rounded-3 bg-secondary-subtle overflow-hidden"> <!-- overflow-hidden untuk mencegah gambar keluar -->
                            <div class="card-header p-0 rounded-3">
                            <img
                                src="https://assets.unileversolutions.com/recipes-v2/236001.jpg"
                                alt=""
                                class="w-100 rounded-top-3"
                                style="object-fit: cover; height: 200px;"> <!-- Membuat gambar terisi penuh dan mempertahankan rasio -->
                            </div>
                            <div class="card-body">
                            <h5 class="card-title fw-bold">{{$menu->nama}}</h5>
                            <p class="card-text">{{$menu->detailPesanans->count()}} Pesanan</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <a href="{{route('pelanggan.menu')}}" class="text-end text-primary fw-bold">Lihat selengkapnya...</a>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Service Start -->
    <div class="container-xxl py-5 bg-gray-light">
        <div class="container">
            <div class="text-start wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">How To Order</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded-3 pt-3">
                        <div class="p-4">
                            <img src="{{asset('svg/meal.svg')}}" alt="Meal Icon">
                            {{-- <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i> --}}
                            <h5>Pilih Menu</h5>
                            <p>Pelanggan memilih dari daftar menu yang tersedia, memperhatikan harga setiap hidangan untuk memilih sesuai dengan preferensi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded-3 pt-3">
                        <div class="p-4">
                            <img src="{{asset('svg/checkout.svg')}}" alt="Checkout Icon">
                            <h5>Checkout</h5>
                            <p>Setelah memilih, pelanggan dapat melakukan checkout pada keranjang pesanan, yang didalamnya meliputi jumlah dan permintaan khusus jika ada.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded-3 pt-3">
                        <div class="p-4">
                            <img src="{{asset('svg/payment.svg')}}" alt="Payment Icon">
                            <h5>Bayar</h5>
                            <p>Setelah pesanan dicatat, pelanggan membayar dengan uang tunai atau menggunakan metode pembayaran lainnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection