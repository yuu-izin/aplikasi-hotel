<?php
require 'datadummy.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Kami</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <!-- header -->
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link text-white" href="#">Home</a>
          <a class="nav-link text-white" href="#">Tentang Kami</a>
          <a class="nav-link text-white" href="#">Transaksi</a>
        </div>
      </div>
    </div>
  </nav>


  <div class="container mt-5">
    <section id="pesan">
      <section id="produk" class="container">
        <h2 class="text-center my-4">Produk</h2>
        <div class="row">
          <?php foreach ($hotel as $kamar) { ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="assets/img/<?= $kamar[2]; ?>" class="card-img-top" alt="<?= $kamar[0]; ?>">
                <div class="card-body text-center">
                  <h5 class="card-title"><?= $kamar[0]; ?></h5>
                  <p class="card-text">Harga: Rp <?= number_format($kamar[1], 0, ',', '.'); ?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="text-center mt-4">
          <a href="form_transaksi.php" class="mb-5 btn btn-primary">Pergi ke Halaman Transaksi</a>
        </div>
      </section>
    </section>
  </div>

  <section class="mt-5 text-center" id="tentang">
      <h2>Tentang Kami</h2>
      <p>Alamat: Jl. Hotel Indah No.1, Jakarta</p>
      <p>Telepon: 021-123456</p>
      <p>Email: info@hotelindah.com</p>
    </section>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2025 Hotel Panca Rizqullah</p>
  </footer>
</body>

</html>