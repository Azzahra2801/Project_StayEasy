<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5">

    <h2 class="fw-bold mb-4">📄 Laporan Reservasi & Pembayaran</h2>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Tamu</th>
                            <th>Nomor Kamar</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (pg_num_rows($data) > 0): ?>
                            <?php while ($row = pg_fetch_assoc($data)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td>Kamar <?= htmlspecialchars($row['nomor_kamar']) ?></td>
                                    <td class="fw-bold text-success">
                                        <?= $row['total_bayar']
                                            ? 'Rp ' . number_format($row['total_bayar'])
                                            : '-' ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    Tidak ada data laporan
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

            <a href="index.php?controller=pemilik&action=dashboard"
               class="btn btn-outline-primary mt-3">
                ⬅ Kembali ke Dashboard
            </a>

        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
