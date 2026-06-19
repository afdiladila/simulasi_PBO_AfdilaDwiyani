<?php
// File: index.php

require_once 'koneksi/database.php';
require_once 'Pendaftaran.php';
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

$database = new Database();
$db = $database->getConnection();

// ==========================================
// LOGIKA SUBMENU DINAMIS
// ==========================================
// 1. Ambil semua kategori jalur pendaftaran yang unik (ada datanya) dari database
$queryJalur = "SELECT DISTINCT jalur_pendaftaran FROM tabel_pendaftaran";
$stmtJalur = $db->prepare($queryJalur);
$stmtJalur->execute();
$listJalur = $stmtJalur->fetchAll(PDO::FETCH_COLUMN);

// 2. Tangkap parameter filter dari URL (jika ada menu yang diklik)
$filterJalur = isset($_GET['jalur']) ? $_GET['jalur'] : 'Semua';

// 3. Ambil data berdasarkan filter submenu yang aktif
$dataReguler   = [];
$dataPrestasi  = [];
$dataKedinasan = [];

if ($filterJalur == 'Semua' || $filterJalur == 'Reguler') {
    $dataReguler = PendaftaranReguler::getDaftarReguler($db);
}
if ($filterJalur == 'Semua' || $filterJalur == 'Prestasi') {
    $dataPrestasi = PendaftaranPrestasi::getDaftarPrestasi($db);
}
if ($filterJalur == 'Semua' || $filterJalur == 'Kedinasan') {
    $dataKedinasan = PendaftaranKedinasan::getDaftarKedinasan($db);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendaftaran Mahasiswa Baru</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 30px; background-color: #f4f7f6; color: #333; }
        h1 { text-align: center; color: #2c3e50; }
        h2 { color: #2c3e50; border-bottom: 2px solid #2c3e50; padding-bottom: 8px; margin-top: 40px; }
        
        /* Style untuk Submenu/Navbar */
        .navbar { background-color: #2c3e50; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        .navbar ul { list-style-type: none; padding: 0; margin: 0; display: flex; }
        .navbar li { margin-right: 20px; }
        .navbar a { color: #fff; text-decoration: none; font-weight: bold; padding: 8px 16px; border-radius: 4px; transition: 0.3s; }
        .navbar a:hover, .navbar a.active { background-color: #34495e; color: #1abc9c; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius: 5px; overflow: hidden; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e0e0e0; }
        th { background-color: #2c3e50; color: white; font-weight: 600; }
        tr:hover { background-color: #f9f9f9; }
        .text-right { text-align: right; }
        .info-unik { font-style: italic; color: #555; background-color: #eef2f7; padding: 4px 8px; border-radius: 4px; display: inline-block; }
    </style>
</head>
<body>

    <h1>Sistem Informasi Pendaftaran Mahasiswa Baru</h1>

    <nav class="navbar">
        <ul>
            <li>
                <a href="index.php?jalur=Semua" class="<?= $filterJalur == 'Semua' ? 'active' : ''; ?>">
                    Semua Jalur
                </a>
            </li>
            
            <?php foreach ($listJalur as $jalur): ?>
                <li>
                    <a href="index.php?jalur=<?= urlencode($jalur); ?>" class="<?= $filterJalur == $jalur ? 'active' : ''; ?>">
                        Jalur <?= htmlspecialchars($jalur); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>


    <?php if ($filterJalur == 'Semua' || $filterJalur == 'Reguler'): ?>
        <h2>Daftar Jalur Reguler</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Calon</th>
                    <th>Asal Sekolah</th>
                    <th>Nilai Ujian</th>
                    <th>Biaya Dasar</th>
                    <th>Informasi Spesifik Jalur</th>
                    <th>Total Biaya Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($dataReguler) > 0): ?>
                    <?php foreach ($dataReguler as $row): ?>
                        <?php 
                        $objek = new PendaftaranReguler(
                            $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                            $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                            $row['pilihan_prodi'], $row['lokasi_kampus']
                        );
                        ?>
                        <tr>
                            <td><?= $objek->getIdPendaftaran(); ?></td>
                            <td><?= htmlspecialchars($objek->getNamaCalon()); ?></td>
                            <td><?= htmlspecialchars($objek->getAsalSekolah()); ?></td>
                            <td><?= $objek->getNilaiUjian(); ?></td>
                            <td>Rp <?= number_format($objek->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                            <td><span class="info-unik"><?= $objek->tampilkanInfoJalur(); ?></span></td>
                            <td class="text-right"><strong>Rp <?= number_format($objek->hitungTotalBiaya(), 0, ',', '.'); ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;">Tidak ada data pendaftar reguler.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <?php if ($filterJalur == 'Semua' || $filterJalur == 'Prestasi'): ?>
        <h2>Daftar Jalur Prestasi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Calon</th>
                    <th>Asal Sekolah</th>
                    <th>Nilai Ujian</th>
                    <th>Biaya Dasar</th>
                    <th>Informasi Spesifik Jalur</th>
                    <th>Total Biaya Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($dataPrestasi) > 0): ?>
                    <?php foreach ($dataPrestasi as $row): ?>
                        <?php 
                        $objek = new PendaftaranPrestasi(
                            $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                            $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                            $row['jenis_prestasi'], $row['tingkat_prestasi']
                        );
                        ?>
                        <tr>
                            <td><?= $objek->getIdPendaftaran(); ?></td>
                            <td><?= htmlspecialchars($objek->getNamaCalon()); ?></td>
                            <td><?= htmlspecialchars($objek->getAsalSekolah()); ?></td>
                            <td><?= $objek->getNilaiUjian(); ?></td>
                            <td>Rp <?= number_format($objek->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                            <td><span class="info-unik"><?= $objek->tampilkanInfoJalur(); ?></span></td>
                            <td class="text-right" style="color: #27ae60;"><strong>Rp <?= number_format($objek->hitungTotalBiaya(), 0, ',', '.'); ?></strong> <small>(Diskon Rp50rb)</small></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;">Tidak ada data pendaftar prestasi.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <?php if ($filterJalur == 'Semua' || $filterJalur == 'Kedinasan'): ?>
        <h2>Daftar Jalur Kedinasan</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Calon</th>
                    <th>Asal Sekolah</th>
                    <th>Nilai Ujian</th>
                    <th>Biaya Dasar</th>
                    <th>Informasi Spesifik Jalur</th>
                    <th>Total Biaya Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($dataKedinasan) > 0): ?>
                    <?php foreach ($dataKedinasan as $row): ?>
                        <?php 
                        $objek = new PendaftaranKedinasan(
                            $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                            $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                            $row['sk_ikatan_dinas'], $row['instansi_sponsor']
                        );
                        ?>
                        <tr>
                            <td><?= $objek->getIdPendaftaran(); ?></td>
                            <td><?= htmlspecialchars($objek->getNamaCalon()); ?></td>
                            <td><?= htmlspecialchars($objek->getAsalSekolah()); ?></td>
                            <td><?= $objek->getNilaiUjian(); ?></td>
                            <td>Rp <?= number_format($objek->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                            <td><span class="info-unik"><?= $objek->tampilkanInfoJalur(); ?></span></td>
                            <td class="text-right" style="color: #c0392b;"><strong>Rp <?= number_format($objek->hitungTotalBiaya(), 0, ',', '.'); ?></strong> <small>(Surcharge 25%)</small></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;">Tidak ada data pendaftar kedinasan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>