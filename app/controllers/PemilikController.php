<?php
require_once '../config/database.php';

class PemilikController {

    private function authCheck() {
        session_start();
        if (!isset($_SESSION['login'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }

    public function login() {
    require '../app/views/pemilik/login.php';
}

    public function pembayaran() {
    $this->authCheck();
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
public function acc() {
    $this->authCheck();
    global $conn;

    $id_pembayaran = $_GET['id'];

    // 1. Update status pembayaran
    pg_query_params($conn,
        "UPDATE pembayaran
         SET status_pembayaran = 'Diterima'
         WHERE id_pembayaran = $1",
        [$id_pembayaran]
    );

    // 2. Ambil id_reservasi
    $res = pg_query_params($conn,
        "SELECT id_reservasi FROM pembayaran WHERE id_pembayaran = $1",
        [$id_pembayaran]
    );
    $row = pg_fetch_assoc($res);
    $id_reservasi = $row['id_reservasi'];

    // 3. Update status reservasi
    pg_query_params($conn,
        "UPDATE reservasi
         SET status_reservasi = 'Dikonfirmasi'
         WHERE id_reservasi = $1",
        [$id_reservasi]
    );

    // 4. Update status kamar jadi Terisi
    pg_query($conn,"
        UPDATE kamar
        SET status = 'Terisi'
        WHERE id_kamar = (
            SELECT id_kamar FROM reservasi WHERE id_reservasi = $id_reservasi
        )
    ");

    header("Location: index.php?controller=pemilik&action=pembayaran");
}

public function dashboard() {
    $this->authCheck();
    global $conn;

    // Total reservasi
    $q1 = pg_query($conn, "SELECT COUNT(*) FROM reservasi");
    $total_reservasi = pg_fetch_result($q1, 0, 0);

    // Total pendapatan (yang sudah diterima)
    $q2 = pg_query($conn, "
        SELECT COALESCE(SUM(total_bayar),0)
        FROM pembayaran
        WHERE status_pembayaran = 'Diterima'
    ");
    $total_pendapatan = pg_fetch_result($q2, 0, 0);

    require '../app/views/pemilik/dashboard.php';
}
public function laporan() {
    global $conn;

    $data = pg_query($conn, "
        SELECT
            t.nama AS nama,
            k.nomor_kamar AS nomor_kamar,
            p.total_bayar AS total_bayar
        FROM pembayaran p
        JOIN reservasi r ON p.id_reservasi = r.id_reservasi
        JOIN tamu t ON r.id_tamu = t.id_tamu
        JOIN kamar k ON r.id_kamar = k.id_kamar
        WHERE p.status_pembayaran = 'Diterima'
        ORDER BY p.tanggal_bayar DESC
    ");

    require '../app/views/pemilik/laporan.php';
}
public function laporanBulanan() {
    $this->authCheck();
    global $conn;

    $data = pg_query($conn, "
        SELECT 
            TO_CHAR(tanggal_bayar, 'YYYY-MM') AS bulan,
            COUNT(*) AS jumlah_transaksi,
            SUM(total_bayar) AS total_pendapatan
        FROM pembayaran
        WHERE status_pembayaran = 'Diterima'
        GROUP BY TO_CHAR(tanggal_bayar, 'YYYY-MM')
        ORDER BY bulan
    ");

    require '../app/views/pemilik/laporan_bulanan.php';
}
}
