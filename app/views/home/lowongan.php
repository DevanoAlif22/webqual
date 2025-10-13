<div class="container-fluid" style="padding-bottom: 200px; padding-top: 100px;">
    <h2 class="mb-4 text-center">Lowongan Tersedia</h2>
    <div class="row g-4">

        <?php foreach ($lowongans as $lowongan): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($lowongan['nama_perusahaan']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($lowongan['posisi']) ?></h6>
                        <p class="card-text">
                            <strong>Lokasi:</strong> <?= htmlspecialchars($lowongan['lokasi']) ?><br>
                            <strong>Kualifikasi:</strong> <?= htmlspecialchars($lowongan['kualifikasi']) ?><br>
                            <strong>Deskripsi:</strong> <?= htmlspecialchars($lowongan['deskripsi']) ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Berlaku sampai: <?= date('d M Y', strtotime($lowongan['tanggal_kadaluarsa'])) ?></small><br>
                        <a href="mailto:<?= htmlspecialchars($lowongan['kontak']) ?>" class="btn btn-sm btn-primary mt-2">Lamar Sekarang</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>