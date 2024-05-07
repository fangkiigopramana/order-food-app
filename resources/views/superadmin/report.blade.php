<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);

        * {
            margin: 0;
            box-sizing: border-box;

        }

        body {
            background: #E0E0E0;
            font-family: 'Roboto', sans-serif;
            background-image: url('');
            background-repeat: repeat-y;
            background-size: 100%;
        }

        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoiceholder {
            width: 100%;
            height: 100%;
            padding-top: 50px;
        }

        #invoice {
            position: relative;
            margin: 0 auto;
            width: 700px;
            background: #FFF;
        }

        [id*='invoice-'] {
            border-bottom: 1px solid #EEE;
            padding: 30px;
        }

        #invoice-top {
            min-height: 120px;
        }

        #invoice-mid {
            min-height: 120px;
        }

        #invoice-bot {
            min-height: 250px;
        }

        .info {
            display: block;
            float: left;
            margin-left: 20px;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        #project {
            margin-left: 52%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }

        .tabletitle {
            padding: 5px;
            background: #EEE;
        }

        .service {
            border: 1px solid #EEE;
        }

        .item {
            width: 50%;
        }

        .itemtext {
            font-size: .9em;
        }

        #legalcopy {
            margin-top: 30px;
        }

        form {
            float: right;
            margin-top: 30px;
            text-align: right;
        }


        .effect2 {
            position: relative;
        }

        .legal {
            width: 70%;
        }
    </style>
</head>

<body>
    <div id="invoiceholder">

        <div id="invoice" class="effect2" style="margin-bottom: 30px;">

            <div id="invoice-top">
                <div class="logo"></div>
                <div class="title text-end">
                    <h1>LAPORAN</h1>
                </div>
            </div>

            <div id="invoice-mid">

                <div class="info" style="padding-top: 0;">
                    <h2 style="margin-bottom: 10px;">PENJUALAN WARMINDO AROMA</h2>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row">
                            <h2>From Date: <span>{{$startDate}}</span></h2>
                        </div>
                        <div class="flex-row">
                            <h2>To Date: <span>{{$endDate}}</span></h2>
                        </div>
                    </div>
                </div>

            </div>

            <div id="invoice-bot">

                <div id="table table-bordered">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA MENU</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">ORDER QUANTITY</th>
                                <th scope="col">TOTAL HARGA</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php
                              $total_harga = 0;
                          @endphp
                            @foreach ($datas as $data)
                            @php
                                $total_harga += $data->total_harga;
                            @endphp
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$data->menu->nama}}</td>
                                <td>{{$data->menu->harga}}</td>
                                <td>{{$data->kuantitas}}</td>
                                <td>{{'Rp ' . number_format($data->total_harga, 0, '.', '.')}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center">Total Harga</td>
                                <td>{{'Rp ' . number_format($total_harga, 0, '.', '.')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div id="legalcopy">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h2>Contact Us</h3>
                            <p class="my-1">+62812-2118-3162</p>
                            <p class="my-1">warmindoaroma@gmail.com</p>
                            <p class="my-1 text-wrap" style="width: 20rem;">Jl. Gondang Barat 1 No.14 B, Bulusan, Tembalang, Kota Semarang, Jawa Tengah, 50277</p>
                        </div>
                        <div>
                            <p>
                                Administrator
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>