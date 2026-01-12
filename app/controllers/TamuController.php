<?php
require_once '../config/database.php';

class TamuController {

    public function cek() {
        require '../app/views/tamu/cek_status.php';
    }

    public function status() {
        global $conn;

        $email = $_POST['email'];

$data = pg_query_params($conn, "
    SELECT r.id_reservasi,
           t.nama,
           k.nomor_kamar,
           r.status_reservasi,
           p.status_pembayaran
    FROM reservasi r
    JOIN tamu t ON r.id_tamu = t.id_tamu
    JOIN kamar k ON r.id_kamar = k.id_kamar
    LEFT JOIN pembayaran p ON r.id_reservasi = p.id_reservasi
    WHERE t.email = $1
", [$email]);

        require '../app/views/tamu/cek_status.php';
    }
}
