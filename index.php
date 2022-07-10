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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          <a class="nav-link" aria-current="page" href="login.php">Login</a>
        </div>
      </div>
    </div>
  </header>
  <section class="product">
    <div class="container-fluid pt-5 pb-5 bg-light">
      <div class="container mt-3">
        <h2 id="product" class="text-center">Welcome to Kantin Kejujuran!</h2>
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
              </div>
            </div>
          <?php endforeach; ?>
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