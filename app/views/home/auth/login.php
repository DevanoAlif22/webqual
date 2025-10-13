<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4>Login</h4>
                <?php if (isset($_SESSION['alertSuccess'])): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['alertSuccess']); ?></div>
                    <?php unset($_SESSION['alertSuccess']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['alertError'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['alertError']); ?></div>
                    <?php unset($_SESSION['alertError']); ?>
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
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    Belum punya akun? <a href="register">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>