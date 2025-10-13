<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-eye"></i> Detail Survei</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color:black;"><i class="fas fa-info-circle"></i> Informasi Survei</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width:220px;">ID Survei</th>
                    <td>: <?= (int)$survei['id_survei']; ?></td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td>: <?= htmlspecialchars($survei['judul_survei']); ?></td>
                </tr>
                <tr>
                    <th>Periode</th>
                    <td>:
                        <?= date('d M Y H:i', strtotime($survei['tanggal_mulai'])) ?>
                        —
                        <?= date('d M Y H:i', strtotime($survei['tanggal_selesai'])) ?>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: <span class="badge bg-<?= $survei['status'] === 'berjalan' ? 'success' : ($survei['status'] === 'selesai' ? 'dark' : 'secondary') ?>">
                            <?= htmlspecialchars(ucfirst($survei['status'])) ?></span>
                    </td>
                </tr>
                <?php if (!empty($survei['deskripsi'])): ?>
                    <tr>
                        <th>Deskripsi</th>
                        <td>: <?= nl2br(htmlspecialchars($survei['deskripsi'])); ?></td>
                    </tr>
                <?php endif; ?>
            </table>

            <hr>

            <div class="d-flex gap-2">
                <a href="/sertifikasi-latihan3/survei" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <a href="/sertifikasi-latihan3/survei-edit?id_survei=<?= $survei['id_survei'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                <a href="/sertifikasi-latihan3/mapping?id_survei=<?= $survei['id_survei'] ?>" class="btn btn-info"><i class="fas fa-link"></i> Mapping Butir</a>
                <a href="/sertifikasi-latihan3/hasil?id_survei=<?= $survei['id_survei'] ?>" class="btn btn-success"><i class="fas fa-chart-line"></i> Hasil WQI</a>
            </div>
        </div>
    </div>

    <?php if (!empty($ringkas)): ?>
        <div class="card mt-3">
            <div class="card-header bg-gradient text-white">
                <h5 style="color:black;"><i class="fas fa-chart-bar"></i> Ringkasan (Aktual)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Dimensi</th>
                                <th class="text-center">Mean Harapan</th>
                                <th class="text-center">Mean Penilaian</th>
                                <th class="text-center">WQI (unit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ringkas as $r): ?>
                                <tr>
                                    <td><?= htmlspecialchars($r['nama_dimensi']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($r['rata_harapan']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($r['rata_jawaban']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($r['wqi_unit']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <small class="text-muted">Catatan: WQI (unit) = AVG(harapan×penilaian) / (AVG(harapan) × 5)</small>
            </div>
        </div>
    <?php endif; ?>
</div>