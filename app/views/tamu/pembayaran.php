<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container mt-4" style="max-width: 600px;">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">

            <h4 class="fw-bold mb-4 text-center">
                Pembayaran Reservasi
            </h4>

            <form 
                method="POST" 
                enctype="multipart/form-data"
                action="index.php?controller=pembayaran&action=simpan"
            >
                <!-- ID Reservasi -->
                <input type="hidden" name="id_reservasi" value="<?= $id_reservasi ?>">

                <!-- Metode -->
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="form-select" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Transfer">Transfer</option>
                        <option value="E-Wallet">E-Wallet</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>

                <!-- Total -->
                <div class="mb-3">
                    <label class="form-label">Total Bayar</label>
                    <input type="number" name="total_bayar" class="form-control" required>
                </div>

                <!-- Bukti -->
                <div class="mb-4">
                    <label class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Kirim Pembayaran
                </button>
            </form>

        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
