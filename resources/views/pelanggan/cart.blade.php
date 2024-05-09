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
                            @foreach ($carts as $index => $cart)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset("svg/food.svg") }}" alt="Product Image"
                                                style="width: 70px; height: auto; margin-right: 10px;">
                                            <div>
                                                <h6 class="fw-bold m-0">{{ $cart["name"] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-items-center text-center">{{ $cart["price"] }}</td>
                                    <td>
                                        <input type="number" min="1" class="form-control w-100"
                                            value="{{ $cart["quantity"] }}" readonly>
                                    </td>
                                    <td class="align-items-center text-center">{{ $cart["total_price"] }}</td>
                                    <td class="align-items-center">
                                        <!-- Tombol untuk menghapus item -->
                                        <form action="{{ route("cart.remove", ["order_id" => $index]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf <!-- Token CSRF untuk keamanan -->
                                            <button type="submit" class="btn btn-danger rounded-3">
                                                <img src="{{ asset("svg/trash.svg") }}" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="col-4">
                    <div class="bg-white rounded rounded-3 p-3">
                        <h6>Total Harga</h6>
                        <span class="text-success fw-bold fs-3">Rp {{ number_format($totalPrice, 0, ".", ".") }}</span>
                        <div class="mt-4">
                            <form action="{{ route("pelanggan.checkout.cart") }}" method="post">
                                @csrf
                                <p class="mb-3 text-danger">*Masukan data diri terlebih dahulu</p>
                                <div class="mb-3 d-none">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" min="1" class="form-control" name="total_harga"
                                        value="{{ $totalPrice }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_meja" class="form-label">Nomor Meja</label>
                                    <input type="number" min="1" class="form-control" name="nomor_meja"
                                        placeholder="XX" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_phone" class="form-label">Nomor Handphone</label>
                                    <input type="text" class="form-control" name="nomor_phone" placeholder="0817267XXXX"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" name="nama_pemesan"
                                        placeholder="Masukkan nama pemesan" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100 rounded-3">Bayar Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">INVOICE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-between">
                        <p>Tanggal: {{date('l, F d y h:i:s');}}</p>
                        <p>No Meja: {{$no_meja}} </p>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastCart as $index => $cart)
                            <tr class="text-center">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$cart['name']}}</td>
                                <td>{{$cart['quantity']}}</td>
                                <td>{{number_format($cart['total_price'], 0, ".", ".")}}</td>
                            </tr>                               
                            @endforeach

                            <tr class="text-center">
                                <td colspan="3" class="text-end">Total:</td>
                                <td>Rp {{ number_format($totalPrice, 0, ".", ".") }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="text-danger">*Silahkan dapat discreenshoot untuk bukti invoicenya</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    @if (session()->has("checkout-order-successfully"))
@php
    $message = session()->get("checkout-order-successfully"); // Mengambil pesan dari sesi
@endphp
    <script>
        Swal.fire({
            title: "Order Sukses",

            text: "Halo",
            icon: "success",
            showDenyButton: true,
            reverseButtons: true,
            showCancelButton: false,
            confirmButtonText: "Lihat Invoice",
            denyButtonText: `Order Kembali`,
            customClass: {
                confirmButton: 'btn btn-success',
                denyButton: 'btn btn-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#invoiceModal').modal('show');
            } else if (result.isDenied) {
                window.location.href = "{{ route("pelanggan.menu") }}";
            }
        });
    </script>
    @endif
@endpush
