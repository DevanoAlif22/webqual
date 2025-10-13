<?php
// opsional: jika controller ikut kirim $dimensi untuk nama
$namaDim = $dimensi['nama_dimensi'] ?? ($pertanyaan['nama_dimensi'] ?? null);
?>
<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-eye"></i> Detail Pertanyaan</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color: black;"><i class="fas fa-question-circle"></i> Informasi Pertanyaan</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width:220px;">ID Pertanyaan</th>
                    <td>: <?= (int)$pertanyaan['id_pertanyaan']; ?></td>
                </tr>
                <tr>
                    <th>Kode</th>
                    <td>: <code><?= htmlspecialchars($pertanyaan['kode_pertanyaan']); ?></code></td>
                </tr>
                <tr>
                    <th>Dimensi</th>
                    <td>: <?= htmlspecialchars($namaDim ?? $pertanyaan['id_dimensi']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:
                        <?php if ((int)$pertanyaan['aktif'] === 1): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Pernyataan</th>
                    <td>: <?= nl2br(htmlspecialchars($pertanyaan['teks_pertanyaan'])); ?></td>
                </tr>
            </table>

            <hr>

            <a href="/sertifikasi-latihan3/pertanyaan" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <a href="/sertifikasi-latihan3/pertanyaan-edit?id_pertanyaan=<?= $pertanyaan['id_pertanyaan'] ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>