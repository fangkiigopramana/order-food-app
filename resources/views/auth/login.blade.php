<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Warmindo Aroma - Login</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: black">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0" style="background-color: black">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-warning mb-4">Warmindo Aroma</h1>
                                        <img src="{{asset('images/foodies-chef-photo.png')}}" alt="Chef Icon">
                                        <p class="text-center text-white">Halo, tim Aroma! Kami senang melihat Anda kembali. Mohon masukkan informasi login Anda untuk memulai.</p>
                                    </div>
                                    <form class="user" method="POST" action="{{route('login.auth')}}">
                                        @csrf 
                                        <div class="form-group">
                                            <label for="username" class="text-white">Username</label>
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kata-sandi" class="text-white">Kata Sandi</label>
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Masukkan kata sandi" required>
                                        </div>
                                        <button type="submit" class="btn btn-success fw-bold btn-user btn-block" style="font-size: 20px; background-color: #008000;">
                                            Masuk
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('{{asset('images/image-chef.png')}}')"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->has('credentials'))
    <script>
        Swal.fire({
            title: "Login Gagal",
            text: @json($errors->first('credentials')),
            icon: "error"
        });
    </script>
    @endif
    @if ($errors->has('username'))
    <script>
        Swal.fire({
            title: "Login Gagal",
            text: @json($errors->first('username')),
            icon: "error"
        });
    </script>
    @endif
    @if ($errors->has('password'))
    <script>
        Swal.fire({
            title: "Login Gagal",
            text: @json($errors->first('password')),
            icon: "error"
        });
    </script>
    @endif


</body>

</html>