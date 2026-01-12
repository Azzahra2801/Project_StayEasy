<?php
require_once __DIR__ . '/../../config/database.php';

class Tamu {

    public static function create($nama, $email, $no_hp) {
        global $conn;
        $query = "
            INSERT INTO tamu (nama, email, no_hp)
            VALUES ('$nama', '$email', '$no_hp')
            RETURNING id_tamu
        ";
        $result = pg_query($conn, $query);
        $data = pg_fetch_assoc($result);
        return $data['id_tamu'];
    }
}
