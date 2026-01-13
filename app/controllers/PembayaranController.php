<?php
require_once '../config/database.php';

class PembayaranController {

    // 🧾 FORM PEMBAYARAN (TAMU)
    public function form() {
        $id_reservasi = $_GET['id_reservasi'];
        require '../app/views/tamu/pembayaran.php';
    }

    // 💾 SIMPAN PEMBAYARAN (TAMU)
    public function simpan() {
        global $conn;

        $id_reservasi = $_POST['id_reservasi'];
        $metode = $_POST['metode_pembayaran'];
        $total = $_POST['total_bayar'];

        // ===== VALIDASI FILE (FOTO SAJA) =====
        $file = $_FILES['bukti_pembayaran'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if ($file['error'] !== UPLOAD_ERR_OK) {
            die("Gagal upload file");
        }

        if (!in_array($file['type'], $allowedTypes)) {
            die("Bukti pembayaran harus berupa gambar JPG / PNG");
        }

        if ($file['size'] > $maxSize) {
            die("Ukuran gambar maksimal 2MB");
        }

        // rename file
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $namaFile = uniqid('bukti_') . '.' . $ext;

        $tujuan = __DIR__ . '/../../public/uploads/' . $namaFile;
        move_uploaded_file($file['tmp_name'], $tujuan);

        // ===== SIMPAN PEMBAYARAN =====
        pg_query_params(
            $conn,
            "INSERT INTO pembayaran
            (id_reservasi, metode_pembayaran, tanggal_bayar, total_bayar, bukti_pembayaran, status_pembayaran)
            VALUES ($1, $2, CURRENT_DATE, $3, $4, 'Menunggu')",
            [$id_reservasi, $metode, $total, $namaFile]
        );

        // ===== UPDATE STATUS RESERVASI SAJA =====
        pg_query_params(
            $conn,
            "UPDATE reservasi
             SET status_reservasi = 'Menunggu Konfirmasi'
             WHERE id_reservasi = $1",
            [$id_reservasi]
        );

        // ⛔ JANGAN update kamar di sini

        header("Location: index.php?controller=pembayaran&action=sukses");
        exit;
    }

    // 🎉 HALAMAN SUKSES
    public function sukses() {
        require '../app/views/pembayaran/sukses.php';
    }

    // 📋 LIST PEMBAYARAN (PEMILIK)
    public function pembayaran() {
        global $conn;

        $data = pg_query($conn, "
            SELECT p.id_pembayaran, t.nama, k.nomor_kamar,
                   p.total_bayar, p.bukti_pembayaran
            FROM pembayaran p
            JOIN reservasi r ON p.id_reservasi = r.id_reservasi
            JOIN tamu t ON r.id_tamu = t.id_tamu
            JOIN kamar k ON r.id_kamar = k.id_kamar
            WHERE p.status_pembayaran = 'Menunggu'
        ");

        require '../app/views/pemilik/konfirmasi_pembayaran.php';
    }

    // ✅ ACC PEMBAYARAN (PEMILIK)
    public function acc() {
        global $conn;
        $id = $_GET['id'];

        // update pembayaran
        pg_query_params(
            $conn,
            "UPDATE pembayaran 
             SET status_pembayaran = 'Diterima' 
             WHERE id_pembayaran = $1",
            [$id]
        );

        // 🔥 update reservasi + kamar SAAT ACC
        pg_query_params(
            $conn,
            "UPDATE reservasi
             SET status_reservasi = 'Dikonfirmasi'
             WHERE id_reservasi = (
                SELECT id_reservasi FROM pembayaran WHERE id_pembayaran = $1
             )",
            [$id]
        );

        pg_query_params(
            $conn,
            "UPDATE kamar
             SET status = 'Terisi'
             WHERE id_kamar = (
                SELECT r.id_kamar
                FROM reservasi r
                JOIN pembayaran p ON p.id_reservasi = r.id_reservasi
                WHERE p.id_pembayaran = $1
             )",
            [$id]
        );

        header("Location: index.php?controller=pembayaran&action=pembayaran");
        exit;
    }
}
