<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5" style="max-width: 900px;">

    <h3 class="fw-bold mb-4 text-center">
        🔍 Cek Status Reservasi & Pembayaran
    </h3>

    <!-- FORM CEK -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">

            <form method="POST" action="index.php?controller=tamu&action=status">
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Email yang digunakan saat reservasi
                    </label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="contoh@email.com"
                           required>
                </div>

                <button class="btn btn-primary w-100">
                    🔎 Cek Status
                </button>
            </form>

        </div>
    </div>

    <!-- HASIL -->
    <?php if (isset($data)): ?>

        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="fw-bold mb-3">📋 Hasil Pencarian</h5>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Tamu</th>
                                <th>Nomor Kamar</th>
                                <th>Status Reservasi</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php if (pg_num_rows($data) == 0): ?>
                            <tr>
                                <td colspan="5" class="text-muted">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php while ($row = pg_fetch_assoc($data)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['nomor_kamar']) ?></td>

                                <td>
                                    <span class="badge bg-info">
                                        <?= htmlspecialchars($row['status_reservasi']) ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if (!$row['status_pembayaran']): ?>
                                        <span class="badge bg-secondary">
                                            Belum Bayar
                                        </span>
                                    <?php elseif ($row['status_pembayaran'] == 'Menunggu'): ?>
                                        <span class="badge bg-warning text-dark">
                                            Menunggu
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success">
                                            Diterima
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if (!$row['status_pembayaran'] || $row['status_pembayaran'] == 'Menunggu'): ?>
                                        <a href="index.php?controller=pembayaran&action=form&id_reservasi=<?= $row['id_reservasi'] ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            💳 Bayar
                                        </a>
                                    <?php else: ?>
                                        <span class="text-success fw-semibold">
                                            ✔ Selesai
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
