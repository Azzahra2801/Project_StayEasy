<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>StayEasy Hotel</title>

    <link rel="stylesheet" href="/Project_StayEasy/public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <style>
        /* RESET */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
            color: #333;
            padding-top: 10px; /* ruang navbar */
        }

        /* NAVBAR */
        .custom-navbar {
            position: sticky;
            top: 0;
            z-index: 999;

            height: 64px;
            background: linear-gradient(90deg, #a2d1d1, #03304b);
            display: flex;
            align-items: center;
        }

        .nav-link-custom {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link-custom:hover {
            color: #f1f1f1;
            text-decoration: underline;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 15px;
            background: #ddddddd7;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header class="custom-navbar">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- LOGO -->
        <a href="/Project_StayEasy/app/views/home/index.php" class="navbar-brand">
            <img src="/Project_StayEasy/public/uploads/images/logoHotel.png"
                 alt="StayEasy"
                 style="width:120px;">
        </a>

        <!-- MENU -->
        <nav class="d-flex align-items-center gap-4">
            <a class="nav-link-custom"
               href="/Project_StayEasy/app/views/home/index.php">Beranda</a>

            <a class="nav-link-custom"
               href="/Project_StayEasy/public/index.php?controller=kamar&action=index">Daftar Kamar</a>

            <a class="nav-link-custom"
               href="/Project_StayEasy/public/index.php?controller=tamu&action=cek">Cek Status</a>

            <a class="btn btn-outline-light btn-sm"
               href="/Project_StayEasy/public/index.php?controller=pemilik&action=login">
                Login Pemilik
            </a>
        </nav>

    </div>
</header>
