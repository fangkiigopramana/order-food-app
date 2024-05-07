@extends("layouts.pelanggan")
@section("content")
    <div class="container-xxl bg-gray-light" style="padding-top: 200px">
        <div class="container">
            <h2 class="text-black animated slideInLeft ff-righteous mb-5">Keranjang</h2>
            <div class="row">
                <div class="col-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="width: 40%">Item</th>
                                <th scope="col">Harga</th>
                                <th scope="col" style="width: 15%">Kuantitas</th>
                                <th scope="col">Jumlah Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset("svg/food.svg") }}" alt="Product Image"
                                                style="width: 70px; height: auto; margin-right: 10px;">
                                            <div>
                                                <h6 class="fw-bold m-0">{{ $cart["name"] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-items-center text-center">{{$cart['price']}}</td>
                                    <td>
                                        <input type="number" min="1" class="form-control w-100" value="{{$cart['quantity']}}">
                                    </td>
                                    <td class="align-items-center text-center">{{$cart['total_price']}}</td>
                                    <td class="align-items-center">
                                        <button type="button" class="btn btn-danger rounded-3">
                                            <img src="{{ asset("svg/trash.svg") }}" alt="">
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-4">
                    <div class="bg-white rounded rounded-3 p-3">
                        <h6>Total Harga</h6>
                        <span class="text-success fw-bold fs-3">Rp {{number_format($totalPrice, 0, '.', '.')}}</span>
                        <div class="mt-4">
                            <p class="mb-3 text-danger">*Masukan data diri terlebih dahulu</p>
                            <div class="mb-3">
                                <label for="nomor_meja" class="form-label">Nomor Meja</label>
                                <input type="number" min="1" class="form-control" name="nomor_meja"
                                    placeholder="XX">
                            </div>
                            <div class="mb-3">
                                <label for="nomor_phone" class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" name="nomor_phone" placeholder="0817267XXXX">
                            </div>
                            <div class="mb-3">
                                <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control" name="nama_pemesan"
                                    placeholder="Masukkan nama pemesan">
                            </div>
                            <button type="button" class="btn btn-success w-100 rounded-3">Pilih Pembayaran</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
