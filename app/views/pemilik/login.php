<?php require_once __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5 d-flex justify-content-center">

    <div class="card shadow-sm border-0 rounded-4" style="width: 100%; max-width: 420px;">
        <div class="card-body p-4">

            <h3 class="fw-bold text-center mb-4">
                Login Pemilik Hotel
            </h3>

            <form method="POST" action="index.php?controller=auth&action=login">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Masukkan username"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>
                </div>

                <button type="submit"
                        class="btn btn-primary w-100">
                    Login
                </button>

            </form>

        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../layout/Footer.php'; ?>
