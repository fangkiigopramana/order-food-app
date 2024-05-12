@extends("layouts.admin")
@push("styles")
    <link href="{{ asset("admin/vendor/datatables/dataTables.bootstrap4.min.css") }}" rel="stylesheet">
@endpush
@section("content")
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Karyawan</h6>
            <p>Daftar semua karyawan termasuk nama pengguna, email, dan perannya.</p>
        </div>
        <div class="card-body">
            <div class="my-3">
                <button type="button" class="btn btn-primary text-orange-500" style="background-color: black"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="{{ asset("svg/plus-people.svg") }}" class="mr-3">
                    <span>Tambah</span>
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Akun Karyawan Baru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{route('superadmin.add.account')}}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label"><h6>Role</h6></label>
                                        <select class="form-select" id="role" name="role" aria-label="Default select example" required>
                                            <option selected>Pilih role</option>
                                            <option value="admin">Admin</option>
                                            <option value="super admin">Super Admin</option>
                                          </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto_profil" class="form-label">Gambar</label>
                                        <input class="form-control" type="file" id="foto_profil" name="foto_profil" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Selesai</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img class="img-profile mx-2" width="50px" src="{{asset('storage/'.$user->profile_photo)}}" alt="Photo Profile">
                                    {{ $user->username }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ Str::of($user->roles->first()->name)->apa() }}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal" data-bs-target="#editUserModal-{{$user->id}}">Edit</button>
                                        <div class="modal fade" id="editUserModal-{{$user->id}}" tabindex="-1" aria-labelledby="editUserModalLabel-{{$user->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Akun Karyawan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('superadmin.update.account', ['user_id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            @method('put')
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="{{$user->nama}}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password" class="form-label">Password</label>
                                                                <input type="password" class="form-control" id="password" name="password" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="role" class="form-label"><h6>Role</h6></label>
                                                                <select class="form-select" id="role" name="role" aria-label="Role Selection" required>
                                                                    <option value="admin" {{ $user->roles->first()->name === 'admin' ? 'selected' : '' }}>Admin</option>
                                                                    <option value="super admin" {{ $user->roles->first()->name === 'super admin' ? 'selected' : '' }}>Super Admin</option>
                                                                </select>                                                                
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="foto_profil" class="form-label">Gambar</label>
                                                                <input class="form-control" type="file" id="foto_profil" name="foto_profil" accept="image/*">
                                                                @if ($user->profile_photo)
                                                                    <p>Gambar saat ini:</p>
                                                                    <img src="{{ asset("/storage/" . $user->profile_photo) }}"
                                                                        alt="Menu Image" style="max-width: 100px;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Ubah Data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="delete_account_{{ $user->id }}"
                                            action="{{ route("superadmin.delete.account", ["id_account" => $user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="button" onclick='deleteAccount(@json([$user->id, $user->username]))' class="btn btn-danger">Hapus</button>
                                        </form>
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
    @if (session()->has("add-account-successfully"))
        @php
            $message = session()->get("add-account-successfully"); // Mengambil pesan dari sesi
        @endphp
        <script>
            Swal.fire({
                title: "Kelola Akun Sukses!",
                text: "{{ addslashes($message) }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session()->has("update-account-successfully"))
        @php
            $message = session()->get("update-account-successfully"); // Mengambil pesan dari sesi
        @endphp
        <script>
            Swal.fire({
                title: "Kelola Akun Sukses!",
                text: "{{ addslashes($message) }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session()->has("update-account-failed"))
        @php
            $message = session()->get("update-account-failed"); // Mengambil pesan dari sesi
        @endphp
        <script>
            Swal.fire({
                title: "Kelola Akun Gagal!",
                text: "{{ addslashes($message) }}",
                icon: "error"
            });
        </script>
    @endif

    <script> 
        function deleteAccount(data){
            const [id, name] = data;

            Swal.fire({
                title: `Anda yakin ingin menghapus data akun ${name}?`,
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Tidak, batal",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete_account_${id}`).submit();
                }
            });
        }
    </script>
@endpush
