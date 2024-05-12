@extends('layouts.admin')
@push('styles')
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endpush
@section('content')
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
        </div>
        <div class="card-body">
            <div class="my-3">
                <form action="{{route('superadmin.print.laporan')}}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between mb-3"> 
                        <div class="flex-fill me-2"> 
                            <label for="start_date" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control"  id="start_date" name="start_date" placeholder="name@example.com" required>
                        </div>
                        <div class="flex-fill ms-2"> 
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="name@example.com" required>
                        </div>
                    </div>                
                    <button type="submit" class="btn btn-primary text-orange-500" style="background-color: black">
                        <span>Print</span>
                    </button>
                </form>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Menu</th>
                            <th>Kategori</th>
                            <th>Total Terjual</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td>
                                    <div class="d-flex flex-row gap-3">
                                        <img src="{{ asset("storage/" . $laporan->menu->gambar) }}" alt="Menu Image" style="max-width: 75px;">
                                        <p>
                                            {{ $laporan->menu->nama }}
                                        </p>
                                    </div>
                                </td>
                                    {{-- {{$laporan->menu->nama}}</td> --}}
                                <td>{{$laporan->menu->category->nama}}</td>
                                <td>{{$laporan->total_kuantitas}}</td>
                                <td>{{$laporan->total_harga}}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
@endpush