<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5">

    <h2 class="fw-bold mb-4">Dashboard Pemilik</h2>

    <!-- STATISTIK -->
    <div class="row g-4 mb-4">

        <!-- Total Reservasi -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Reservasi</h6>
                    <h3 class="fw-bold"><?= $total_reservasi ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Pendapatan</h6>
                    <h3 class="fw-bold text-success">
                        Rp <?= number_format($total_pendapatan ?? 0) ?>
                    </h3>
                </div>
            </div>
        </div>

    </div>

    <!-- MENU AKSI -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <h5 class="fw-bold mb-3">Menu Pemilik</h5>

            <div class="d-grid gap-3">

                <a href="index.php?controller=pemilik&action=laporan"
                   class="btn btn-outline-primary">
                    📊 Lihat Laporan Reservasi
                </a>

                <a href="index.php?controller=pemilik&action=pembayaran"
                   class="btn btn-outline-success">
                    ✅ Konfirmasi Pembayaran
                </a>

                <a href="index.php?controller=pemilik&action=laporanBulanan"
                   class="btn btn-outline-info">
                    📆 Laporan Bulanan
                </a>

                <a href="index.php?controller=auth&action=logout"
                   class="btn btn-outline-danger">
                    🔓 Logout
                </a>

            </div>

        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
