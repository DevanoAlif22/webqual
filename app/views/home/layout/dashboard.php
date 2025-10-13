<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($title) ? htmlspecialchars($title) . ' — ' : '' ?>Dashboard Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (opsional untuk ikon menu) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            background: #f6f8fb;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            /* tinggi navbar */
            bottom: 0;
            left: 0;
            width: var(--sidebar-width);
            padding: 1rem;
            background: #0d6efd;
            color: #fff;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: #e9f2ff;
            border-radius: .5rem;
            margin: 2px 0;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, .15);
            color: #fff;
        }

        .content-wrapper {
            margin-top: 56px;
            /* tinggi navbar */
            margin-left: var(--sidebar-width);
            padding: 1.25rem;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                display: none;
                /* disembunyikan di mobile, gunakan offcanvas */
            }

            .content-wrapper {
                margin-left: 0;
            }
        }

        /* Kartu ringkas di dashboard */
        .stat-card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .06);
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <button class="btn btn-outline-light d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand fw-semibold" href="/sertifikasi-latihan3/survei">Dashboard Admin</a>

            <div class="ms-auto d-flex align-items-center">
                <span class="text-white-50 me-3 small">
                    <?php
                    session_start();
                    $adminName = isset($_SESSION['admin']['username']) ? $_SESSION['admin']['username'] : 'Admin';
                    echo 'Masuk sebagai: <strong>' . htmlspecialchars($adminName) . '</strong>';
                    ?>
                </span>
                <a class="btn btn-light btn-sm" href="/sertifikasi-latihan3/logout">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar (desktop) -->
    <aside class="sidebar d-none d-lg-block">
        <div class="mb-3">
            <div class="fw-bold">Menu Utama</div>
            <hr class="border-light opacity-25">
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" href="/sertifikasi-latihan3/survei"><i class="bi bi-calendar-check me-2"></i> Survei</a>
            <a class="nav-link" href="/sertifikasi-latihan3/dimensi"><i class="bi bi-diagram-3 me-2"></i> Dimensi</a>
            <a class="nav-link" href="/sertifikasi-latihan3/pertanyaan"><i class="bi bi-ui-checks-grid me-2"></i> Pertanyaan</a>
            <a class="nav-link" href="/sertifikasi-latihan3/mapping"><i class="bi bi-link-45deg me-2"></i> Mapping Survei ↔ Pertanyaan</a>
            <a class="nav-link" href="/sertifikasi-latihan3/responden"><i class="bi bi-people me-2"></i> Responden</a>
            <a class="nav-link" href="/sertifikasi-latihan3/jawaban"><i class="bi bi-list-check me-2"></i> Jawaban</a>
            <a class="nav-link" href="/sertifikasi-latihan3/hasil"><i class="bi bi-bar-chart-line me-2"></i> Hasil WQI</a>

            <div class="mt-3 mb-2 fw-bold">Pengaturan</div>
            <hr class="border-light opacity-25 mt-0">
            <a class="nav-link" href="/sertifikasi-latihan3/pengguna"><i class="bi bi-person-gear me-2"></i> Pengguna (Admin)</a>
            <a class="nav-link" href="/sertifikasi-latihan3/situs"><i class="bi bi-globe2 me-2"></i> Situs</a>
        </nav>
    </aside>

    <!-- Offcanvas Sidebar (mobile) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
        <div class="offcanvas-header bg-primary text-white">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <nav class="nav flex-column p-3">
                <a class="nav-link" href="/sertifikasi-latihan3/survei"><i class="bi bi-calendar-check me-2"></i> Survei</a>
                <a class="nav-link" href="/sertifikasi-latihan3/dimensi"><i class="bi bi-diagram-3 me-2"></i> Dimensi</a>
                <a class="nav-link" href="/sertifikasi-latihan3/pertanyaan"><i class="bi bi-ui-checks-grid me-2"></i> Pertanyaan</a>
                <a class="nav-link" href="/sertifikasi-latihan3/mapping"><i class="bi bi-link-45deg me-2"></i> Mapping Survei ↔ Pertanyaan</a>
                <a class="nav-link" href="/sertifikasi-latihan3/responden"><i class="bi bi-people me-2"></i> Responden</a>
                <a class="nav-link" href="/sertifikasi-latihan3/jawaban"><i class="bi bi-list-check me-2"></i> Jawaban</a>
                <a class="nav-link" href="/sertifikasi-latihan3/hasil"><i class="bi bi-bar-chart-line me-2"></i> Hasil WQI</a>
                <hr>
                <a class="nav-link" href="/sertifikasi-latihan3/pengguna"><i class="bi bi-person-gear me-2"></i> Pengguna (Admin)</a>
                <a class="nav-link" href="/sertifikasi-latihan3/situs"><i class="bi bi-globe2 me-2"></i> Situs</a>
                <a class="nav-link text-danger mt-2" href="/sertifikasi-latihan3/logout"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a>
            </nav>
        </div>
    </div>

    <!-- Konten -->
    <main class="content-wrapper container-fluid">
        <?php
        // Flash messages
        if (!empty($_SESSION['alertSuccess'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                . $_SESSION['alertSuccess']
                . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
            unset($_SESSION['alertSuccess']);
        }
        if (!empty($_SESSION['alertError'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                . $_SESSION['alertError']
                . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
            unset($_SESSION['alertError']);
        }
        ?>

        <!-- Slot konten halaman -->
        <?php include $content; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- (Opsional) Auto-set active link berdasar URL sederhana -->
    <script>
        (function() {
            const links = document.querySelectorAll('.sidebar .nav-link, #offcanvasSidebar .nav-link');
            const path = window.location.pathname.replace(/\/+$/, '').toLowerCase();
            links.forEach(a => {
                const href = a.getAttribute('href');
                if (!href) return;
                if (path.includes(href.replace(/\/+$/, '').toLowerCase())) {
                    a.classList.add('active');
                }
            });
        })();
    </script>
</body>

</html>