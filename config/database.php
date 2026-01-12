<?php
$host = "localhost";
$dbname = "stayeasy";
$user = "postgres";
$pass = "ARAcantik01";

$conn = pg_connect(
    "host=$host dbname=$dbname user=$user password=$pass"
);

if (!$conn) {
    die("Koneksi database gagal");
}
