<?php
require_once '../config/database.php';

$controller = $_GET['controller'] ?? 'kamar';
$action = $_GET['action'] ?? 'index';

$c = null;

switch ($controller) {

    case 'kamar':
        require_once '../app/controllers/KamarController.php';
        $c = new KamarController();
        break;

    case 'reservasi':
        require_once '../app/controllers/ReservasiController.php';
        $c = new ReservasiController();
        break;

    case 'pembayaran':
        require_once '../app/controllers/PembayaranController.php';
        $c = new PembayaranController();
        break;

    case 'pemilik':
        require_once '../app/controllers/PemilikController.php';
        $c = new PemilikController();
        break;

    case 'auth': 
        require_once '../app/controllers/AuthController.php';
        $c = new AuthController();
        break;

    case 'tamu':
        require_once '../app/controllers/TamuController.php';
        $c = new TamuController();
        break;

    case 'home':
        require '../app/views/home/index.php';
        exit;

    default:
        die("Controller tidak ditemukan");
}

// 🚨 VALIDASI PENTING
if (!$c) {
    die("Controller tidak valid");
}

if (!method_exists($c, $action)) {
    die("Action tidak ditemukan");
}

$c->$action();
