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

    // upload bukti
    $file = $_FILES['bukti_pembayaran'];
    $namaFile = time() . '_' . $file['name'];
    $tujuan = __DIR__ . '/../../public/uploads/' . $namaFile;
    move_uploaded_file($file['tmp_name'], $tujuan);

    // simpan pembayaran
    pg_query_params(
        $conn,
        "INSERT INTO pembayaran
        (id_reservasi, metode_pembayaran, tanggal_bayar, total_bayar, bukti_pembayaran, status_pembayaran)
        VALUES ($1, $2, CURRENT_DATE, $3, $4, 'Menunggu')",
        [$id_reservasi, $metode, $total, $namaFile]
    );

    // 🔥 UPDATE STATUS RESERVASI
    pg_query_params(
        $conn,
        "UPDATE reservasi
         SET status_reservasi = 'Menunggu Konfirmasi'
         WHERE id_reservasi = $1",
        [$id_reservasi]
    );

    // 🔥 UPDATE STATUS KAMAR → TERISI
    pg_query_params(
        $conn,
        "UPDATE kamar
         SET status = 'Terisi'
         WHERE id_kamar = (
            SELECT id_kamar FROM reservasi WHERE id_reservasi = $1
         )",
        [$id_reservasi]
    );

    // redirect ke halaman sukses
    header("Location: index.php?controller=pembayaran&action=sukses");
    exit;
}

// 🎉 HALAMAN SUKSES PEMBAYARAN
public function sukses() {
    require '../app/views/pembayaran/sukses.php';
}


    // 📋 DAFTAR PEMBAYARAN MENUNGGU (PEMILIK)
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

        pg_query_params(
            $conn,
            "UPDATE pembayaran 
             SET status_pembayaran = 'Diterima' 
             WHERE id_pembayaran = $1",
            [$id]
        );

        echo "<h3>Pembayaran berhasil dikonfirmasi</h3>";
        echo "<a href='index.php?controller=pembayaran&action=pembayaran'>Kembali</a>";
    }
}
