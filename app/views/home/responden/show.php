<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="bi bi-person-badge"></i> Detail Responden</h3>
        </div>
    </div>

    <div class="card-modern">
        <div class="card-body" style="padding:1.25rem 1.5rem;">
            <table class="table table-borderless mb-0">
                <tr>
                    <th style="width:220px;">Nama</th>
                    <td>: <?= htmlspecialchars($responden['nama']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: <?= htmlspecialchars($responden['email']); ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>: <?= htmlspecialchars($responden['jenis_kelamin']); ?></td>
                </tr>
                <tr>
                    <th>Umur</th>
                    <td>: <?= (int)$responden['umur']; ?></td>
                </tr>
                <tr>
                    <th>Jurusan/Asal</th>
                    <td>: <?= htmlspecialchars($responden['jurusan']); ?></td>
                </tr>
                <tr>
                    <th>Waktu Kirim</th>
                    <td>: <?= date('d M Y H:i', strtotime($responden['dibuat_pada'])); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <?php if (!empty($jawabans)): ?>
        <div class="card-modern mt-3">
            <div class="card-body" style="padding:1.25rem 1.5rem;">
                <h6 class="mb-3"><i class="bi bi-list-check me-1"></i> Ringkasan Jawaban</h6>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th style="width:240px;">Dimensi</th>
                                <th>Pertanyaan</th>
                                <th style="width:140px;" class="text-center">Harapan</th>
                                <th style="width:140px;" class="text-center">Penilaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jawabans as $j): ?>
                                <tr>
                                    <td><?= htmlspecialchars($j['nama_dimensi']); ?></td>
                                    <td><?= htmlspecialchars($j['teks_pertanyaan']); ?></td>
                                    <td class="text-center"><?= (int)$j['harapan']; ?></td>
                                    <td class="text-center"><?= (int)$j['jawaban']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="/webqual/admin/responden" class="btn btn-outline-secondary mt-2"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </div>
    <?php else: ?>
        <a href="/webqual/admin/responden" class="btn btn-outline-secondary mt-3"><i class="bi bi-arrow-left"></i> Kembali</a>
    <?php endif; ?>
</div>