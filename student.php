<?php
require('process.php');

$rb = readBalance();

if (isset($_GET['type'])) {
    $rp = readProduct2();
    header("refresh:5;url=index.php");
} else {
    $rp = readProduct1();
}
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
                    <a class="nav-link active" aria-current="page" href="student.php">Home</a>
                    <a class="nav-link" aria-current="page">Current Balance :</a>
                    <a class="nav-link active"><?php echo "Rp." . number_format($rb['saldo_toko'], 2, ',', '.') ?></a>
                    <a class="nav-link" name="edit_saldo" id="edit_saldo" data-bs-toggle="modal" data-bs-target="#myModal1"><i class="fa-solid fa-money-bill-transfer"></i></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    <section class="product">
        <div class="container-fluid pt-5 pb-5 bg-light">
            <div class="container mt-3">
                <h2 id="product" class="text-center">Welcome to Kantin Kejujuran!</h2>
                <div class="row mt-5">
                    <table class="table mt-3">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Sort by Name</th>
                                <th>
                                    <a name="asc_name" id="asc_name" href="process.php?type=an" style="color:#fac431;"><i class="fa-solid fa-sort-up"></i></a>
                                    <a name="desc_name" id="desc_name" href="process.php?type=dn" style="color:#fac431;"><i class="fa-solid fa-sort-down"></i></a>
                                </th>
                                <th>
                                    <button name="add_product" id="add_product" class="btn" type="button" data-bs-toggle="modal" data-bs-target="#myModal2" style="background-color: #fac431;">Add New Item</button>
                                </th>
                                <th scope="col">Sort by Time</th>
                                <th>
                                    <a name="asc_time" id="asc_time" href="process.php?type=at" style="color:#fac431;"><i class="fa-solid fa-sort-up"></i></a>
                                    <a name="desc_time" id="desc_time" href="process.php?type=dt" style="color:#fac431;"><i class="fa-solid fa-sort-down"></i></a>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row mt-1 pt-2 mb-4 gx-4 gy-3">
                    <?php foreach ($rp as $rps) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card crop-img">
                                <img src="file/<?= $rps['gambar_produk']; ?>" class="card-img-top" width="200" height="200">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?= $rps['nama_produk'] ?></h5>
                                    <hr>
                                    <p class="card-text mb-3" style="text-align: justify;"><?= $rps['deskripsi_produk']; ?> </p>
                                    <i class="card-text" style="text-align: justify; font-size:13px; color:#585858;">Time added : <?= date('d-m-Y', strtotime($rps["waktu_produk_ditambahkan"])); ?> </i>
                                </div>
                                <div class="card-footer" style="text-align: center;">
                                    <p class="card-text py-1">
                                        <a href="process.php?id_product=<?= $rps['id_produk']; ?>" class="btn btn-block col-12" style="background-color: #fac431;">Rp. <?= number_format($rps['harga_produk'], 2, ',', '.') ?> <i class="fa-brands fa-shopify"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="show_modal1">
        <div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Info Balance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="process.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_mahasiswa">Balance Amount</label>
                                <input type="text" name="store_balance" id="nama_mahasiswa_update" class="form-control mt-1" placeholder="Enter the balance amount" required autofocus>
                            </div>
                        </div>
                        <div class="modal-footer mt-2">
                            <button data-bs-dismiss="modal" type="button" class="btn btn-secondary">Cancel</button>
                            <button name="add_balance" id="add_balance" type="submit" class="btn" style="background-color: #fac431;">Add Balance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="show_modal2">
        <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add New Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="process.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control mt-1" placeholder="Enter product name" required autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <label for="product_image">Product Image</label>
                                <input class="form-control mt-1" name="fupload" type="file" id="fupload" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description_product">Description</label>
                                <input type="text" name="description_product" id="description_product" class="form-control mt-1" placeholder="Enter description of product" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="product_price">Product Price</label>
                                <input type="text" name="product_price" id="product_price" class="form-control mt-1" placeholder="Enter product price" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button name="add_product" id="add_product" type="submit" class="btn" style="background-color: #fac431;">Add Item</button>
                        </div>
                    </form>
                </div>
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
</body>

</html>