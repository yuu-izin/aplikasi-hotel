<?php
session_start();
if (!isset($_SESSION['invoice'])) {
    header("Location: index.php");
    exit();
}

$invoice = $_SESSION['invoice'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Invoice Pemesanan Hotel</h2>
            <table class="table">
                <tr>
                    <td><strong>Nama Pemesan</strong></td>
                    <td>: <?php echo $invoice['nama_pemesan']; ?></td>
                </tr>
                <tr>
                    <td><strong>Nomor Identitas</strong></td>
                    <td>: <?php echo $invoice['nomor_identitas']; ?></td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td>
                    <td>: <?php echo $invoice['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <td><strong>Tipe Kamar</strong></td>
                    <td>: <?php echo ucfirst($invoice['tipe_kamar']); ?></td>
                </tr>
                <tr>
                    <td><strong>Durasi Menginap</strong></td>
                    <td>: <?php echo $invoice['durasi_menginap']; ?> Hari</td>
                </tr>
                <tr>
                    <td><strong>Tambahan Breakfast</strong></td>
                    <td>: <?php echo $invoice['breakfast'] ? 'Ya' : 'Tidak'; ?></td>
                </tr>
                <tr>
                    <td><strong>Total Bayar</strong></td>
                    <td>: Rp <?php echo number_format($invoice['total'], 0, ',', '.'); ?></td>
                </tr>
            </table>
            <a href="index.php" class="btn btn-primary mt-3">Kembali</a>
        </div>
    </div>
</body>
</html>
