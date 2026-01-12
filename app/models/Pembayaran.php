<?php
require_once __DIR__ . '/../../config/database.php';

class Pembayaran {

    public static function create($id_reservasi, $metode, $total) {
        global $conn;

        pg_query($conn, "
            INSERT INTO pembayaran
            (id_reservasi, metode_pembayaran, tanggal_bayar, total_bayar, status_pembayaran)
            VALUES
            ($id_reservasi, '$metode', NOW(), $total, 'lunas')
        ");
    }
}
