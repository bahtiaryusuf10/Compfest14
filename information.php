<?php
require('process.php');

$ri = readIncome();
$rpse = readProduct3();
$rpso = readProduct4();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kantin Kejujuran</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="icon" type="image/png" href="assets/logo/logo0.png">
    <script src="https://kit.fontawesome.com/05cd8dc01c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <header class="navbar sticky-top navbar-expand-lg navbar-dark main-nav">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/logo/logo1.png" class="main-logo me-2">
                <strong>Kantin Kejujuran</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <div class="navbar-nav ms-auto py-2">
                    <a class="nav-link" aria-current="page" href="student.php">Home</a>
                    <a class="nav-link">Total Income :</a>
                    <a class="nav-link active"><?php echo "Rp." . number_format($ri['total_income'], 2, ',', '.') ?></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['nama']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="information.php">Information</a></li>
                            <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </header>
    <section class="tableAll_item">
        <div class="container-fluid mt-3 pt-5 pb-3">
            <h2 class="text-center">Information of your item</h2>
            <div class="container mt-5">
                <h4>Items For Sale</h4>
                <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
                    <table class="table table-hover" style="width:100%;" id="example">
                        <thead>
                            <tr style="background-color:#222222; color:white; vertical-align:middle;">
                                <th class="text-center">No</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Time Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($rpse as $rpses) :
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $i ?>.</td>
                                    <td style="text-align: center;"><img src="file/<?= $rpses['gambar_produk'] ?>" width="200" height="150"></td>
                                    <td style="text-align: justify;"><?= $rpses['nama_produk'] ?></td>
                                    <td style="text-align: justify;"><?= $rpses['deskripsi_produk'] ?></td>
                                    <td style="text-align: center;"><?php echo "Rp." . number_format($rpses['harga_produk'], 2, ',', '.') ?></td>
                                    <td style="text-align: center;"><?= date('d-m-Y', strtotime($rpses['waktu_produk_ditambahkan'])); ?></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="tableSold_item">
        <div class="container mt-3">
            <h4>Items Sold</h4>
            <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
                <table class="table table-hover" style="width:100%;" id="example">
                    <thead>
                        <tr style="background-color:#222222; color:white; vertical-align:middle;">
                            <th class="text-center">No</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($rpso as $rpsos) :
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $i ?></td>
                                <td style="text-align: center;"><img src="file/<?= $rpsos['gambar_produk'] ?>" width="200" height="150"></td>
                                <td style="text-align: justify;"><?= $rpsos['nama_produk'] ?></td>
                                <td style="text-align: justify;"><?= $rpsos['deskripsi_produk'] ?></td>
                                <td style="text-align: center;"><?php echo "Rp." . number_format($rpsos['harga_produk'], 2, ',', '.') ?></td>
                                <td style="text-align: center;"><a class="nav-link" href='process.php?id_item_delete=<?= $rpsos['id_produk'] ?>' onclick="return confirm('Are you sure to withdraw?')"><i class="fa-solid fa-money-bill-transfer"></i></a></td>
                            </tr>
                        <?php
                            $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <footer>
        <div class="main-footer-menu main py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <div class="mb-3">
                            <a href="home.html">
                                <img src="assets/logo/logo1.png">
                            </a>
                        </div>
                        <p style="text-align: justify;">
                            Setiap makanan dipercaya dapat menjadi moodbooster bagi banyak orang. Jika makanan tersebut merupakan makanan manis, maka dapat membantu mengurangi hormon kortisol dalam tubuh anda. Ayo beli makanan di Kantin Kejujuran!
                        </p>
                    </div>
                    <div class="col-lg-3 px-5">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="">Promo</a></li>
                            <li><a href="">Reviews</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 px-5">
                        <h3>Legal</h3>
                        <ul>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Halal Certificate</a></li>
                            <li><a href="">Terms and Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 px-5">
                        <h3>Social Media</h3>
                        <p>
                            <a href="https://web.facebook.com/profile.php?id=100008803922151" target="_blank" class="social ms-4"><i class="fa-brands fa-facebook fa-lg"></i></a>
                            <a href="https://www.instagram.com/mhmmdbahtiar10/" target="_blank" class="social ms-4"><i class="fa-brands fa-instagram fa-lg"></i></a>
                            <a href="https://wa.link/rzf3ym" target="_blank" class="social ms-4"><i class="fa-brands fa-whatsapp fa-lg"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-footer-copyright text-center py-1">
            Copyright © 2022 Kantin Kejujuran by Muhammad Yusuf Bahtiar.
        </div>
    </footer>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>