<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <h2 class="mb-4">Form Reservasi</h2>

    <?php if ($id_kamar): ?>
        <form method="POST" action="index.php?controller=reservasi&action=simpan">
            <input type="hidden" name="id_kamar" value="<?= $id_kamar ?>">

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Check-in</label>
                <input type="date" name="checkin" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" name="checkout" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Simpan Reservasi
            </button>
        </form>
    <?php else: ?>
        <div class="alert alert-danger">
            ID kamar tidak ditemukan.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
