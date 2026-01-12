<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5">

    <h2 class="fw-bold mb-4">📊 Laporan Pendapatan Bulanan</h2>

    <!-- TABEL LAPORAN -->
    <div class="card shadow-sm border-0 rounded-4 mb-5">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        $no = 1;
                        $data_array = [];
                        while ($row = pg_fetch_assoc($data)): 
                            $data_array[] = $row;
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-medium"><?= $row['bulan'] ?></td>
                            <td><?= $row['jumlah_transaksi'] ?></td>
                            <td class="fw-bold text-success">
                                Rp <?= number_format($row['total_pendapatan']) ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>

                        <?php if (empty($data_array)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Data belum tersedia
                            </td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- GRAFIK BAR MANUAL -->
    <h4 class="fw-bold mb-3">📈 Grafik Pendapatan per Bulan</h4>

    <?php
    $max = 0;
    foreach ($data_array as $d) {
        if ($d['total_pendapatan'] > $max) {
            $max = $d['total_pendapatan'];
        }
    }
    ?>

    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">

            <?php foreach ($data_array as $d): 
                $width = ($max > 0) ? ($d['total_pendapatan'] / $max) * 100 : 0;
            ?>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fw-medium"><?= $d['bulan'] ?></span>
                        <span class="fw-bold">
                            Rp <?= number_format($d['total_pendapatan']) ?>
                        </span>
                    </div>

                    <div class="progress" style="height: 22px;">
                        <div class="progress-bar bg-primary"
                             role="progressbar"
                             style="width: <?= $width ?>%">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($data_array)): ?>
                <p class="text-muted text-center mb-0">
                    Grafik belum tersedia
                </p>
            <?php endif; ?>

        </div>
    </div>

    <!-- KEMBALI -->
<a href="index.php?controller=pemilik&action=dashboard"
   class="btn btn-outline-primary">
    ⬅ Kembali ke Dashboard
    </a>

</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
