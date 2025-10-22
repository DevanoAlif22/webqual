<style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Poppins", sans-serif;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-body {
        background: #ffffff;
        border-radius: 15px;
    }

    h4.text-primary {
        color: #0d6efd !important;
        letter-spacing: 0.5px;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #d0d7de;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0256c4);
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0256c4, #003a91);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(2, 86, 196, 0.25);
    }

    .alert {
        border-radius: 10px;
        font-size: 0.9rem;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="fw-bold text-center mb-4 text-primary">Login Admin</h4>

                <?php if (isset($_SESSION['alertError'])): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($_SESSION['alertError']); ?>
                    </div>
                    <?php unset($_SESSION['alertError']); ?>
                <?php endif; ?>

                <form method="POST" action="" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>