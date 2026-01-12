<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5">

    <h3 class="fw-bold mb-4">Daftar Kamar</h3>

    <!-- FILTER -->
    <form method="GET" action="index.php" class="mb-4">
        <input type="hidden" name="controller" value="kamar">
        <input type="hidden" name="action" value="index">

        <div class="row g-2">

            <div class="col-md-3">
                <select name="tipe" class="form-select">
                    <option value="">Tipe Kamar</option>
                    <?php foreach (['Single','Double','Family','Suite'] as $t): ?>
                        <option value="<?= $t ?>" <?= ($_GET['tipe'] ?? '') == $t ? 'selected' : '' ?>>
                            <?= $t ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <select name="harga" class="form-select">
                    <option value="">Harga</option>
                    <option value="1" <?= ($_GET['harga'] ?? '')=='1'?'selected':'' ?>>&lt; Rp 300.000</option>
                    <option value="2" <?= ($_GET['harga'] ?? '')=='2'?'selected':'' ?>>Rp 300.000 - 500.000</option>
                    <option value="3" <?= ($_GET['harga'] ?? '')=='3'?'selected':'' ?>>&gt; Rp 500.000</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="kapasitas" class="form-select">
                    <option value="">Jumlah Tamu</option>
                    <?php foreach ([1,2,4] as $k): ?>
                        <option value="<?= $k ?>" <?= ($_GET['kapasitas'] ?? '')==$k?'selected':'' ?>>
                            <?= $k ?> Tamu
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">Filter</button>
            </div>

        </div>
    </form>

    <!-- LIST KAMAR -->
    <div class="row g-4">

        <?php if (empty($kamar)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Kamar tidak ditemukan.
                </div>
            </div>
        <?php endif; ?>

        <?php foreach ($kamar as $k): ?>
            <div class="col-md-6">
                <div class="card shadow-sm h-100 rounded-4">

                    <img src="uploads/images/<?= $k['foto'] ?: 'hotel.png' ?>"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;">

                    <div class="card-body">
                        <h5 class="fw-bold"><?= htmlspecialchars($k['tipe_kamar']) ?></h5>

                        <small class="text-muted d-block mb-2">
                            👤 <?= $k['kapasitas'] ?> Tamu
                        </small>

                        <h6 class="fw-bold mb-3">
                            Rp <?= number_format($k['harga']) ?>/malam
                        </h6>

                        <?php if ($k['status'] === 'Kosong'): ?>
                            <a href="index.php?controller=reservasi&action=form&id=<?= $k['id_kamar'] ?>"
                               class="btn btn-primary w-100">
                                Pesan Sekarang
                            </a>
                        <?php else: ?>
                            <button class="btn btn-secondary w-100" disabled>Terisi</button>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
