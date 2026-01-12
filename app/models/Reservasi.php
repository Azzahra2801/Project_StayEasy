<?php
require_once __DIR__ . '/../../config/database.php';

class Reservasi {

    public static function create($id_tamu, $id_kamar, $checkin, $checkout) {
    global $conn;

    $result = pg_query($conn, "
        INSERT INTO reservasi
        (id_tamu, id_kamar, tanggal_checkin, tanggal_checkout, status_reservasi)
        VALUES
        ($id_tamu, $id_kamar, '$checkin', '$checkout', 'aktif')
        RETURNING id_reservasi
    ");

    $data = pg_fetch_assoc($result);

    pg_query($conn, "
        UPDATE kamar SET status = 'dipesan'
        WHERE id_kamar = $id_kamar
    ");

    return $data['id_reservasi'];
    }
}
