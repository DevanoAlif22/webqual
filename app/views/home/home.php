<div class="container mt-4 mb-5">

    <!-- Hero / Tentang -->
    <div class="text-center mb-5">
        <h1 class="mb-3">Selamat Datang di Portal Karir</h1>
        <p class="lead">Temukan lowongan kerja, informasi magang, dan pengembangan karir terbaik untuk masa depanmu.</p>
        <a href="lowongan.php" class="btn btn-primary">Lihat Semua Lowongan</a>
    </div>

    <!-- Lowongan Terbaru -->
    <h2 class="mb-4">Lowongan Terbaru</h2>
    <div class="row g-4 mb-5">
        <?php foreach ($lowongans as $l): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($l['nama_perusahaan']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($l['posisi']) ?></h6>
                        <p class="card-text">
                            <strong>Lokasi:</strong> <?= htmlspecialchars($l['lokasi']) ?><br>
                            <small class="text-muted">Berlaku sampai: <?= date('d M Y', strtotime($l['tanggal_kadaluarsa'])) ?></small>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="mailto:<?= htmlspecialchars($l['kontak']) ?>" class="btn btn-sm btn-primary">Lamar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Informasi Terbaru -->
    <h2 class="mb-4">Informasi Terbaru</h2>
    <div class="row g-4 mb-5">
        <?php foreach ($informasis as $info): ?>
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($info['judul']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($info['isi']) ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        Diterbitkan: <?= date('d M Y', strtotime($info['tanggal'])) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- CTA -->
    <div class="text-center py-4 bg-light rounded shadow-sm">
        <h4 class="mb-3">Butuh bantuan atau ingin bertanya?</h4>
        <a href="contact.php" class="btn btn-outline-primary">Hubungi Kami</a>
    </div>

</div>