@extends("layouts.pelanggan")
@section("content")
    <div class="container-xxl py-5 bg-gray-light">
        <div class="container mx-auto justify-items-center align-content-center mt-5">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <span class="fa fa-search form-control-feedback"></span>
                </span>
                <input type="text" class="form-control p-3" id="searchInput" placeholder="Cari nama menu..."
                    aria-label="Pencarian Menu" aria-describedby="basic-addon1">
            </div>
        </div>
        <div id="exTab1" class="container">
            <p class="mb-2">Pilih jenis menu:</p>
            <ul class="nav nav-pills gap-3" id="menuTypeFilter">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-category="makanan">Makanan</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-category="minuman">Minuman</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-category="camilan">Camilan</a>
                </li>
            </ul>

            <div class="tab-content clearfix">
                <div class="my-4 row g-3" id="menus">

                    @foreach ($menus as $menu)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 menu-item"
                            data-category="{{ $menu->category->nama }}">
                            <div class="card">
                                <img src="https://assets.unileversolutions.com/recipes-v2/236001.jpg" class="card-img-top"
                                    alt="Image 1">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $menu->nama }}</h6>
                                    <div class="d-flex flex-row gap-4 justify-content-between">
                                        <h5 class="menu-category align-content-xl-center">Rp
                                            {{ number_format($menu->harga, 0, ",", ".") }}</h5>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#orderMenuModal-{{ $menu->id }}">
                                            <p class="m-0" style="font-size: 12px">Keranjang</p>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="orderMenuModal-{{ $menu->id }}" tabindex="-1"
                                            aria-labelledby="orderMenuModal-{{ $menu->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="orderMenuModal-{{ $menu->id }}Label">Tambahkan Keranjang</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('pelanggan.addCart',['menu_id'=>$menu->id])}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                                <div class="mb-3">
                                                                <label for="nama_menu" class="form-label">Nama Menu</label>
                                                                <input type="text" class="form-control" name="nama_menu" value="{{$menu->nama}}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kuantitas" class="form-label">Kuantitas</label>
                                                                <input type="number" min="1" class="form-control" name="kuantitas">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            const filter = this.value.toUpperCase();
            const cardContainer = document.getElementById("menus");
            const cards = cardContainer.getElementsByClassName("menu-item");
            for (let i = 0; i < cards.length; i++) {
                const title = cards[i].querySelector(".card-title");
                if (title.innerText.toUpperCase().includes(filter)) {
                    cards[i].style.display = "block";
                } else {
                    cards[i].style.display = "none";
                }
            }
        });

        document.getElementById("menuTypeFilter").addEventListener("click", function(event) {
            if (event.target.tagName === "A") {
                event.preventDefault();
                console.log('masuk')

                // Ambil kategori dari elemen klik
                const filter = event.target.getAttribute("data-category").toUpperCase();
                console.log(filter)

                // Ambil semua kartu menu
                const cardContainer = document.getElementById("menus");
                console.log(cardContainer)
                const cards = cardContainer.getElementsByClassName("menu-item");
                console.log(cards)

                // Tampilkan/hide kartu berdasarkan filter
                for (let i = 0; i < cards.length; i++) {
                    const cardCategory = cards[i].getAttribute("data-category").toUpperCase();
                    if (cardCategory === filter) {
                        cards[i].style.display = "block";
                    } else {
                        cards[i].style.display = "none";
                    }
                }

                // Update kelas 'active' pada link menu
                document.querySelectorAll("#menuTypeFilter .nav-link").forEach((link) => {
                    link.classList.remove("active");
                });
                event.target.classList.add("active");
            }
        });
    </script>
@endpush
