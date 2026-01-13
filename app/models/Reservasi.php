<?php
require_once __DIR__ . '/../../config/database.php';

class Reservasi {

    public static function create($id_tamu, $id_kamar, $checkin, $checkout) {
        global $conn;

        $result = pg_query_params($conn, "
            INSERT INTO reservasi
            (id_tamu, id_kamar, tanggal_checkin, tanggal_checkout, status_reservasi)
            VALUES ($1, $2, $3, $4, 'Menunggu Pembayaran')
            RETURNING id_reservasi
        ", [$id_tamu, $id_kamar, $checkin, $checkout]);

        $data = pg_fetch_assoc($result);

        // ❌ JANGAN update status kamar di sini
        return $data['id_reservasi'];
    }
}
