@extends("layouts.admin")
@push("styles")
    <link href="{{ asset("admin/vendor/datatables/dataTables.bootstrap4.min.css") }}" rel="stylesheet">
@endpush
@section("content")
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Nomor Meja</th>
                            <th>Daftar Pesanan</th>
                            <th>Nama Pemesan</th>
                            <th>Nomor Telp. Pemesan</th>
                            <th>Total </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $pesanan->no_meja }}</td>
                                <td class="text-start">
                                    @foreach ($pesanan->detailPesanan as $menu)
                                        <li>{{$menu->menu->nama . ' ('.$menu->kuantitas.' item)     ' . '(Rp '. number_format($menu->menu->harga, 0, '.','.').')'}}</li>
                                    @endforeach
                                </td>
                                <td>{{ $pesanan->nama_pemesan }}</td>
                                <td>{{ $pesanan->nomor_phone }}</td>
                                <td>{{ "Rp " . number_format($pesanan->total_harga, 0, ".", ".") }}</td>
                                <td>
                                    <h5>
                                        <span class="badge text-white bg-{{$pesanan->status == 'proses' ? 'warning' : ($pesanan->status == 'sukses' ? 'success' : 'danger')}}">{{ Str::of($pesanan->status)->apa()}}</span>
                                    </h5>
                                </td>
                                <td>
                                    <div class="d-flex flex-row gap-3 justify-items-center align-content-center justify-content-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPesananModal{{$pesanan->id}}">Edit</button>
                                        <div class="modal fade" id="editPesananModal{{$pesanan->id}}" tabindex="-1"
                                            aria-labelledby="editPesananModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('admin.update.status.order', ['pesanan_id' => $pesanan->id])}}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editPesananModalLabel">Edit Status Pesanan</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama_pemesan" class="form-label">Nama Pemesan|Meja</label>
                                                                <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" value="{{$pesanan->nama_pemesan.' ( Meja No.'.$pesanan->no_meja.' )'}}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status Pesanan</label>
                                                                <select class="form-select" aria-label="Default select example" name="status" required>
                                                                    <option selected>Open this select menu</option>
                                                                    @foreach (['proses','batal','sukses'] as $status)
                                                                    <option value="{{$status}}" @if ($pesanan->status === $status) selected @endif >{{Str::of($status)->apa()}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Ubah Status</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset("admin/vendor/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("admin/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset("admin/vendor/jquery-easing/jquery.easing.min.js") }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset("admin/js/sb-admin-2.min.js") }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset("admin/vendor/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("admin/vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset("admin/js/demo/datatables-demo.js") }}"></script>
@endpush
