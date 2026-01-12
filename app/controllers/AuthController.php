<?php
require_once '../config/database.php';
session_start();

class AuthController {

    public function login() {
        global $conn;

        // Kalau form dikirim
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = pg_query_params(
                $conn,
                "SELECT * FROM user_pemilik WHERE username=$1 AND password=$2",
                [$username, $password]
            );

            if (pg_num_rows($query) > 0) {
                // ✅ LOGIN BERHASIL
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;

                header("Location: index.php?controller=pemilik&action=dashboard");
                exit;
            } else {
                echo "<p style='color:red'>Username atau password salah</p>";
            }
        }

        // TAMPILKAN FORM LOGIN
        require '../app/views/pemilik/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
           header("Location: index.php?controller=home");
    exit;
    }
}
