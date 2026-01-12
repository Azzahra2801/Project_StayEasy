<?php
require_once __DIR__ . '/../models/Kamar.php';

class KamarController {

    public function index() {
        global $conn;

        $where  = [];
        $params = [];
        $i = 1;

        // FILTER TIPE
        if (!empty($_GET['tipe'])) {
            $where[] = "tipe_kamar = $" . $i;
            $params[] = $_GET['tipe'];
            $i++;
        }

        // FILTER KAPASITAS
        if (!empty($_GET['kapasitas'])) {
            $where[] = "kapasitas >= $" . $i;
            $params[] = $_GET['kapasitas'];
            $i++;
        }

        // FILTER HARGA
        if (!empty($_GET['harga'])) {
            if ($_GET['harga'] == 1) {
                $where[] = "harga < 300000";
            } elseif ($_GET['harga'] == 2) {
                $where[] = "harga BETWEEN 300000 AND 500000";
            } elseif ($_GET['harga'] == 3) {
                $where[] = "harga > 500000";
            }
        }

        $sql = "SELECT * FROM kamar";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $result = !empty($params)
            ? pg_query_params($conn, $sql, $params)
            : pg_query($conn, $sql);

        // PASTIKAN ARRAY
        $kamar = pg_fetch_all($result);
        if (!$kamar) {
            $kamar = [];
        }

        require __DIR__ . '/../views/tamu/index.php';
    }
}
