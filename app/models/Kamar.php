<?php
require_once __DIR__ . '/../../config/database.php';

class Kamar {

    public static function getAll() {
        global $conn;
        $result = pg_query($conn, "SELECT * FROM kamar ORDER BY nomor_kamar");
        return pg_fetch_all($result);
    }

    public static function find($id) {
        global $conn;
        $result = pg_query(
            $conn,
            "SELECT * FROM kamar WHERE id_kamar = $id"
        );
        return pg_fetch_assoc($result);
    }
}
