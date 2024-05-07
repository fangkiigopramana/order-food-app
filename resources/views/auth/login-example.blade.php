<!DOCTYPE html>

<html lang="en">

<head>
    <base href="../../../" />
    <title>Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes</title>
    <link href="{{ asset("css/login.bundle.css") }}" rel="stylesheet">
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
</head>
<!--end::Head-->

<body class="bg-dark">
    <div class="bg-dark container">
        <div class="row m-5">
            <div class="col-md-6 bg-black p-5">
                <h3 class="pb-3 text-center text-primary">Warmindo Aroma</h3>
                <img src="{{asset('images/foodies-chef-photo.png')}}" class="mx-auto d-block mb-3" alt="foodies-chef-photo" style="max-width: 200px; height: auto;">
                <p class="text-center text-white">Halo, tim Aroma! Kami senang melihat Anda kembali. Mohon masukkan informasi login Anda untuk memulai.</p>
                <div class="form-style">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label text-white">Nama</label>
                            <input type="text" class="form-control rounded-pill px-3" name="name" placeholder="Masukkan nama pengguna">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-white">Email address</label>
                            <input type="password" class="form-control rounded-pill px-3" id="password" placeholder="Masukkan kata sandi">
                        </div>
                        <div class="pb-2">
                            <button type="submit" class="btn btn-success w-100 fw-bolder mt-2 rounded-pill">Masuk</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-md-6 d-none d-md-block">
                <img src="{{asset('images/image-chef.png')}}"
                    class="img-fluid" style="min-height:100%;" />
            </div>
        </div>
    </div>
</body>

</html>
