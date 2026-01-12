<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5">

    <h2 class="fw-bold mb-4">Konfirmasi Pembayaran</h2>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Tamu</th>
                            <th>Kamar</th>
                            <th>Total Bayar</th>
                            <th>Bukti</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (pg_num_rows($data) > 0): ?>
                            <?php while ($row = pg_fetch_assoc($data)): ?>
                                <tr>
                                    <td><?= $row['nama'] ?></td>
                                    <td>Kamar <?= $row['nomor_kamar'] ?></td>
                                    <td class="fw-semibold">
                                        Rp <?= number_format($row['total_bayar']) ?>
                                    </td>
                                    <td>
                                        <a href="uploads/<?= $row['bukti_pembayaran'] ?>"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-secondary">
                                            👁 Lihat Bukti
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?controller=pembayaran&action=acc&id=<?= $row['id_pembayaran'] ?>"
                                           class="btn btn-sm btn-success"
                                           onclick="return confirm('Yakin konfirmasi pembayaran ini?')">
                                            ✅ ACC
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Tidak ada pembayaran menunggu konfirmasi
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

            <a href="index.php?controller=pemilik&action=dashboard"
               class="btn btn-outline-primary mt-3">
                ← Kembali ke Dashboard
            </a>

        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
