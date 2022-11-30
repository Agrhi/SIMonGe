<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="10"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Gempa</title>

    <!-- Font -->
    <link href="http://fonts.cdnfonts.com/css/ds-digital" rel="stylesheet">

    <!-- Bi Ivon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- Css Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Js Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- CDN Js -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- css datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <!-- JS Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <style>
        .hitung {
            font-family: 'DS-Digital', sans-serif;
            font-size: 120px;
            margin-top: -25px;
            margin-bottom: -25px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-display"></i>
                Monitoring
            </a>
        </div>
    </nav>

    <div class="container">

        <h2 class="text-center mt-3 mb-4">Monitoring Gempa & Liquifaksi</h2>

        <!-- Koneksi database mengambil data terkhir masuk -->
        <?php
        include 'koneksi.php';
        // Pakai ini kalau data output PLTB (85 data) data terakhir
        $data = mysqli_query($con, "SELECT * FROM `log` ORDER BY id DESC LIMIT 1;");
        $new = mysqli_fetch_row($data); ?>


        <div class="row mb-4">

            <!-- Pake Card -->
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-header"><i class="bi bi-thermometer-half"></i> Suhu</div>
                    <div class="card-body text-center">
                        <!-- <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6 hitung">100</div>
                                <div class="col-md-4 satuan"><b>°C</b></div>
                            </div> -->
                        <div class="hitung">100 °C</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-header"><i class="bi bi-thermometer-snow"></i> Kelembaban</div>
                    <div class="card-body text-center">
                        <div class="hitung">100 °F</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-header"><i class="bi bi-activity"></i> Getaran</div>
                    <div class="card-body text-center">
                        <div class="hitung">100 SR</div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Tabel menampilkan semua data -->
        <div class="mt-1 mb-5">
            <table class="table caption-top table-bordered" id="myTable">
                <caption>Data Gempa</caption>
                <thead class="table-light">
                    <tr>
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Waktu</td>
                        <td>Suhu</td>
                        <td>Kelembaban</td>
                        <td>Getaran</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = '1';
                    include 'koneksi.php';
                    // Pakai ini kalau data output PLTB (85 data)
                    $result = mysqli_query($con, "SELECT * FROM log ORDER BY id ASC");
                    // Pakai ini kalau mau Tampilkan data Validasi (15 data)
                    // $result = mysqli_query($con, "SELECT * FROM ina219val ORDER BY id ASC");
                    while ($d = mysqli_fetch_array($result)) {
                    ?>
                        <tr align=center>
                            <td><?= $no++; ?></td>
                            <td><?= $d['tgl']; ?></td>
                            <td><?= $d['wkt']; ?></td>
                            <td><?= $d['suhu']; ?></td>
                            <td><?= $d['kelembaban']; ?></td>
                            <td><?= $d['getaran']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <!-- <nav class="navbar navbar-dark bg-primary">
        <div class="container" style="justify-content: center;">
            <div class="row" style="text-align: center;">
                <div class="col-md-6">
                    <h5>Teknik Informatika</h5>
                    <h2>Universitas Tadulako</h2>
                </div>
                <div class="col-md-6">
                    <h5>ProAction</h5>
                    <h2>Lembaga Robotika</h2>
                </div>
            </div>
        </div>
    </nav> -->
    <nav class="navbar navbar-dark bg-primary mt-1">
        <div class="container">
            <p class="text-center">
            <h5 class="text-white">
                Copyright © 2022 by F55116065 Informatics Engineering
            </h5>
            </p>
        </div>
    </nav>
</body>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</html>