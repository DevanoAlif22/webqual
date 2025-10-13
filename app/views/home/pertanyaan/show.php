<?php
// opsional: jika controller ikut kirim $dimensi untuk nama
$namaDim = $dimensi['nama_dimensi'] ?? ($pertanyaan['nama_dimensi'] ?? null);
?>

<style>
    .detail-header {
        margin-bottom: 1.5rem;
    }

    .detail-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.5rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-header h2 i {
        color: #64748b;
        font-size: 1.4rem;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .info-card-header {
        background: linear-gradient(90deg, #4c6ef5, #5f3dc4);
        color: white;
        padding: 1.25rem 1.5rem;
    }

    .info-card-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-card-header h5 i {
        color: white;
    }

    .info-card-body {
        padding: 1.5rem;
    }

    .info-table {
        margin: 0;
    }

    .info-table tr {
        border-bottom: 1px solid #f1f5f9;
    }

    .info-table tr:last-child {
        border-bottom: none;
    }

    .info-table th {
        width: 220px;
        padding: 1rem 0;
        font-weight: 600;
        color: #64748b;
        font-size: 0.95rem;
    }

    .info-table td {
        padding: 1rem 0;
        color: #1e293b;
        font-size: 0.95rem;
    }

    .badge-status {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.45rem 0.9rem;
        border-radius: 8px;
        letter-spacing: 0.4px;
    }

    .btn-action-detail {
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-back {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .btn-edit {
        background: #fef3c7;
        color: #d97706;
    }

    .btn-edit:hover {
        background: #fbbf24;
        color: white;
    }

    @media (max-width: 768px) {
        .detail-header h2 {
            font-size: 1.25rem;
        }

        .info-card-body {
            padding: 1rem;
        }

        .info-table th {
            width: 150px;
            font-size: 0.875rem;
        }

        .info-table td {
            font-size: 0.875rem;
        }

        .btn-action-detail {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="page-content">
    <div class="detail-header">
        <h2>
            <i class="bi bi-question-circle"></i>
            Detail Pertanyaan
        </h2>
    </div>

    <div class="info-card">
        <div class="info-card-header">
            <h5><i class="bi bi-info-circle"></i> Informasi Pertanyaan</h5>
        </div>
        <div class="info-card-body">
            <table class="info-table table table-borderless">
                <tr>
                    <th>ID Pertanyaan</th>
                    <td><strong>#<?= (int)$pertanyaan['id_pertanyaan']; ?></strong></td>
                </tr>
                <tr>
                    <th>Kode</th>
                    <td><code><?= htmlspecialchars($pertanyaan['kode_pertanyaan']); ?></code></td>
                </tr>
                <tr>
                    <th>Dimensi</th>
                    <td><?= htmlspecialchars($namaDim ?? $pertanyaan['id_dimensi']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if ((int)$pertanyaan['aktif'] === 1): ?>
                            <span class="badge-status bg-success text-white">Aktif</span>
                        <?php else: ?>
                            <span class="badge-status bg-secondary text-white">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Pernyataan</th>
                    <td><?= nl2br(htmlspecialchars($pertanyaan['teks_pertanyaan'])); ?></td>
                </tr>
            </table>

            <div class="mt-4 d-flex gap-2 flex-wrap">
                <a href="/sertifikasi-latihan3/pertanyaan" class="btn-action-detail btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="/sertifikasi-latihan3/pertanyaan-edit?id_pertanyaan=<?= $pertanyaan['id_pertanyaan'] ?>" class="btn-action-detail btn-edit">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
