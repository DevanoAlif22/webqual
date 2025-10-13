<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4>Register</h4>
                <?php session_start();
                if (isset($_SESSION['alertError'])): ?>
                    <div class="alert alert-danger text-center">
                        <?= $_SESSION['alertError'];
                        unset($_SESSION['alertError']); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    Sudah punya akun? <a href="/mvc-tiket-bus/login">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>