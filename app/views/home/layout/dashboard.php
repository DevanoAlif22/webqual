<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($title) ? htmlspecialchars($title) . ' — ' : '' ?>Dashboard Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 280px;
            --topbar-height: 70px;
            --sidebar-bg: #1a2332;
            --sidebar-hover: #2d3848;
            --primary-color: #4c6ef5;
            --text-muted: #8b95a5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fc;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Top Navigation Bar */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--topbar-height);
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 2rem;
        }

        .topbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .topbar-brand i {
            font-size: 1.8rem;
        }

        .topbar-menu {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: #f8f9fc;
            border-radius: 50px;
        }

        .topbar-user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary-color), #667eea);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .topbar-user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .topbar-user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2d3748;
        }

        .topbar-user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .btn-logout {
            background: transparent;
            border: 2px solid #e2e8f0;
            color: #64748b;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-logout:hover {
            background: #fee;
            border-color: #fcc;
            color: #dc2626;
        }

        .mobile-menu-toggle {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #2d3748;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--topbar-height));
            background: var(--sidebar-bg);
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.3s ease;
            z-index: 999;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar-menu {
            padding: 1.5rem 0;
        }

        .menu-section {
            margin-bottom: 2rem;
        }

        .menu-section-title {
            padding: 0 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: #b8c1d3;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
            gap: 1rem;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .menu-item i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        .menu-item:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .menu-item.active {
            background: var(--sidebar-hover);
            color: #fff;
            border-left: 4px solid var(--primary-color);
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-color);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--topbar-height));
            transition: margin-left 0.3s ease;
        }

        /* Footer */
        .footer {
            margin-left: var(--sidebar-width);
            padding: 1.5rem 2rem;
            background: #fff;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            transition: margin-left 0.3s ease;
        }

        .footer-text {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin: 0;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-top: 0.5rem;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        /* Mobile Styles */
        @media (max-width: 991.98px) {
            .topbar {
                padding: 0 1rem;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .topbar-brand {
                font-size: 1.25rem;
            }

            .topbar-user-info {
                display: none;
            }

            .btn-logout span {
                display: none;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .footer {
                margin-left: 0;
                padding: 1rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 1rem;
            }

            .topbar-user {
                padding: 0.25rem 0.5rem;
            }

            .btn-logout {
                padding: 0.5rem;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                justify-content: center;
            }
        }

        /* Overlay untuk mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        .sidebar-overlay.show {
            display: block;
        }
    </style>
</head>

<body>

    <!-- Top Navigation Bar -->
    <nav class="topbar">
        <button class="mobile-menu-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>

        <a href="/webqual/admin/survei" class="topbar-brand">
            <i class="bi bi-grid-3x3-gap-fill"></i>
            <span>Dashboard</span>
        </a>

        <div class="topbar-menu">
            <div class="topbar-user">
                <div class="topbar-user-avatar">
                    <?php
                    session_start();
                    $adminName = isset($_SESSION['admin']['username']) ? $_SESSION['admin']['username'] : 'Admin';
                    echo strtoupper(substr($adminName, 0, 1));
                    ?>
                </div>
                <div class="topbar-user-info">
                    <div class="topbar-user-name"><?= htmlspecialchars($adminName) ?></div>
                    <div class="topbar-user-role">Administrator</div>
                </div>
            </div>

            <a class="btn-logout" href="/webqual/admin/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </a>
        </div>
    </nav>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <nav class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-section-title">Menu Utama</div>
                <a class="menu-item" href="/webqual/admin/survei">
                    <i class="bi bi-calendar-check"></i>
                    <span>Survei</span>
                </a>
                <a class="menu-item" href="/webqual/admin/dimensi">
                    <i class="bi bi-diagram-3"></i>
                    <span>Dimensi</span>
                </a>
                <a class="menu-item" href="/webqual/admin/pertanyaan">
                    <i class="bi bi-ui-checks-grid"></i>
                    <span>Pertanyaan</span>
                </a>
                <a class="menu-item" href="/webqual/admin/mapping">
                    <i class="bi bi-link-45deg"></i>
                    <span>Mapping Survei</span>
                </a>
                <a class="menu-item" href="/webqual/admin/responden">
                    <i class="bi bi-people"></i>
                    <span>Responden</span>
                </a>
                <a class="menu-item" href="/webqual/admin/jawaban">
                    <i class="bi bi-list-check"></i>
                    <span>Jawaban</span>
                </a>
                <a class="menu-item" href="/webqual/admin/hasil">
                    <i class="bi bi-bar-chart-line"></i>
                    <span>Hasil WQI</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Pengaturan</div>
                <a class="menu-item" href="/webqual/admin/pengguna">
                    <i class="bi bi-person-gear"></i>
                    <span>Pengguna</span>
                </a>
                <a class="menu-item" href="/webqual/admin/situs">
                    <i class="bi bi-globe2"></i>
                    <span>Situs</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
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

        <!-- Konten halaman -->
        <?php include $content; ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p class="footer-text">© 2025 Dashboard Admin. All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Support</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle Sidebar untuk Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        // Set active menu berdasarkan URL
        (function() {
            const menuItems = document.querySelectorAll('.menu-item');
            const currentPath = window.location.pathname.replace(/\/+$/, '').toLowerCase();

            menuItems.forEach(item => {
                const href = item.getAttribute('href');
                if (!href) return;

                const itemPath = href.replace(/\/+$/, '').toLowerCase();
                if (currentPath.includes(itemPath) && itemPath !== '/') {
                    item.classList.add('active');
                }
            });
        })();

        // Close sidebar saat klik menu di mobile
        if (window.innerWidth <= 991) {
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function() {
                    toggleSidebar();
                });
            });
        }
    </script>
</body>

</html>