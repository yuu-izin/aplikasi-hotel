<?php
session_start();

// Initialize variables to avoid "undefined variable" warnings
$nama_pemesan   = '';
$jenis_kelamin  = '';
$nomor_identitas = '';
$tipe_kamar     = '';
$tanggal_pesan  = '';
$durasi_menginap = 1;
$include_breakfast = false;
$total = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hitung'])) {
  $nama_pemesan = $_POST['nama_pemesan'] ?? '';
  $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
  $nomor_identitas = $_POST['nomor_identitas'] ?? '';
  $tipe_kamar = $_POST['tipe_kamar'] ?? '';
  $tanggal_pesan = $_POST['tanggal_pesan'] ?? '';
  $durasi_menginap = isset($_POST['durasi_menginap']) ? (int)$_POST['durasi_menginap'] : 1;
  $include_breakfast = isset($_POST['breakfast']);

  $harga_kamar = [
    'standar'   => 500000,
    'deluxe'    => 780000,
    'executive' => 1000000
  ];

  $harga = $harga_kamar[$tipe_kamar] ?? 0;
  $total = $harga * $durasi_menginap;

  if ($durasi_menginap > 3) {
    $total *= 0.9; // Diskon 10%
  }

  if ($include_breakfast) {
    $total += 80000 * $durasi_menginap;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['simpan'])) {
  $nama_pemesan    = $_POST['nama_pemesan'] ?? '';
  $jenis_kelamin   = $_POST['jenis_kelamin'] ?? '';
  $nomor_identitas = $_POST['nomor_identitas'] ?? '';
  $tipe_kamar      = $_POST['tipe_kamar'] ?? '';
  $tanggal_pesan   = $_POST['tanggal_pesan'] ?? '';
  $durasi_menginap = isset($_POST['durasi_menginap']) ? (int)$_POST['durasi_menginap'] : 1;
  $include_breakfast = isset($_POST['breakfast']);

  $harga_kamar = [
      'standar'   => 500000,
      'deluxe'    => 780000,
      'executive' => 1000000
  ];

  $harga = $harga_kamar[$tipe_kamar] ?? 0;
  $total = $harga * $durasi_menginap;

  if ($durasi_menginap > 3) {
      $total *= 0.9; // Diskon 10%
  }

  if ($include_breakfast) {
      $total += 80000 * $durasi_menginap;
  }

  $_SESSION['invoice'] = [
    'nama_pemesan'    => $nama_pemesan,
    'jenis_kelamin'   => $jenis_kelamin,
    'nomor_identitas' => $nomor_identitas,
    'tipe_kamar'      => $tipe_kamar,
    'tanggal_pesan'   => $tanggal_pesan,
    'durasi_menginap' => $durasi_menginap,
    'breakfast'       => $include_breakfast,
    'total'           => $total
  ];
  header('Location: invoice.php');
  exit();
}

?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <h1 class="text-center my-4">Transaksi Pemesanan</h1>
    <form method="post">
      <div class="mb-3">
        <label>Nama Pemesan</label>
        <input type="text" class="form-control" name="nama_pemesan" required value="<?= $nama_pemesan ?>">
      </div>

      <div class="mb-3">
        <label>Jenis Kelamin</label><br>
        <input type="radio" name="jenis_kelamin" value="Laki-laki" <?= isset($jenis_kelamin) && $jenis_kelamin == 'Laki-laki' ? 'checked' : '' ?> required> Laki-laki
        <input type="radio" name="jenis_kelamin" value="Perempuan" <?= isset($jenis_kelamin) && $jenis_kelamin == 'Perempuan' ? 'checked' : '' ?> required> Perempuan
      </div>

      <div class="mb-3">
        <label>Nomor Identitas (16 digit)</label>
        <input type="text" class="form-control" name="nomor_identitas" maxlength="16" required value="<?= $nomor_identitas ?>">
      </div>

      <div class="mb-3">
        <label for="tipe_kamar">Tipe Kamar</label>
        <select class="form-control" name="tipe_kamar">
          <option value="standar" <?= isset($tipe_kamar) && $tipe_kamar == 'standar' ? 'selected' : '' ?>>Standar - Rp 500.000</option>
          <option value="deluxe" <?= isset($tipe_kamar) && $tipe_kamar == 'deluxe' ? 'selected' : '' ?>>Deluxe - Rp 780.000</option>
          <option value="executive" <?= isset($tipe_kamar) && $tipe_kamar == 'executive' ? 'selected' : '' ?>>Executive - Rp 1.000.000</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Tanggal Pesan</label>
        <input type="date" class="form-control" name="tanggal_pesan" required value="<?= $tanggal_pesan ?>">
      </div>

      <div class="mb-3">
        <label>Jumlah Hari Menginap</label>
        <input type="number" class="form-control" name="durasi_menginap" min="1" value="<?= $durasi_menginap ?>">
      </div>

      <div class="mb-3">
        <input type="checkbox" name="breakfast" <?= isset($include_breakfast) && $include_breakfast ? 'checked' : '' ?>>
        <label>Tambahkan Breakfast (Rp 80.000/hari)</label>
      </div>

      <div class="mb-3">
        <button type="submit" name="hitung" class="btn btn-primary">Hitung Total Bayar</button>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
      </div>

      <?php if (isset($total)): ?>
        <h3 class="mt-4">Total Bayar: Rp <?= number_format($total, 0, ',', '.') ?></h3>
      <?php endif; ?>

    </form>
  </div>
</body>

</html>