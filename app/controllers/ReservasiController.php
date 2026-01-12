<?php
require_once __DIR__ . '/../models/Tamu.php';
require_once __DIR__ . '/../models/Reservasi.php';

class ReservasiController {

    // 1️⃣ tampilkan form reservasi
    public function form() {
        $id_kamar = $_GET['id'] ?? null;

        if (!$id_kamar) {
            die("ID kamar tidak ditemukan");
        }

        require_once __DIR__ . '/../views/tamu/reservasi.php';
    }

    // 2️⃣ simpan data reservasi
    public function simpan() {
        $id_tamu = Tamu::create(
            $_POST['nama'],
            $_POST['email'],
            $_POST['no_hp']
        );

        $id_reservasi = Reservasi::create(
            $id_tamu,
            $_POST['id_kamar'],
            $_POST['checkin'],
            $_POST['checkout']
        );

        header("Location: index.php?controller=pembayaran&action=form&id_reservasi=$id_reservasi");
        exit;
    }
}
