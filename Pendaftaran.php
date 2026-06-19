<?php
// File: Pendaftaran.php

abstract class Pendaftaran {
    // Properti Terenkapsulasi (Protected)
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar; // Sesuai penamaan camelCase di soal

    // Constructor untuk memetakan data dari database ke properti objek
    public function __construct($id, $nama, $sekolah, $nilai, $biayaDasar) {
        $this->id_pendaftaran = $id;
        $this->nama_calon = $nama;
        $this->asal_sekolah = $sekolah;
        $this->nilai_ujian = $nilai;
        $this->biayaPendaftaranDasar = $biayaDasar;
    }

    // Getter (Optional, diperlukan jika class luar ingin mengambil data karena properti di-protected)
    public function getIdPendaftaran() { return $this->id_pendaftaran; }
    public function getNamaCalon() { return $this->nama_calon; }
    public function getAsalSekolah() { return $this->asal_sekolah; }
    public function getNilaiUjian() { return $this->nilai_ujian; }
    public function getBiayaPendaftaranDasar() { return $this->biayaPendaftaranDasar; }

    // --- Metode Abstrak (Tanpa Isi/Body) ---
    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}
?>