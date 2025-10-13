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
    }

    .info-card-header {
        background: #f8f9fc;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-card-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-card-header h5 i {
        color: #4c6ef5;
        font-size: 1.2rem;
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
        width: 200px;
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

    .info-label {
        color: #94a3b8;
        margin-right: 0.5rem;
    }

    .badge.status-badge {
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 0.4rem 1rem;
        border-radius: 50px;
    }

    .periode-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .periode-info i {
        color: #94a3b8;
    }

    .action-buttons-group {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
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

    .btn-mapping {
        background: #dbeafe;
        color: #2563eb;
    }

    .btn-mapping:hover {
        background: #3b82f6;
        color: white;
    }

    .btn-result {
        background: #d1fae5;
        color: #059669;
    }

    .btn-result:hover {
        background: #10b981;
        color: white;
    }

    .summary-table {
        margin: 0;
    }

    .summary-table thead {
        background: #f8f9fc;
    }

    .summary-table thead th {
        padding: 1rem;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border: none;
    }

    .summary-table tbody td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .summary-table tbody tr:last-child td {
        border-bottom: none;
    }

    .summary-table tbody tr:hover {
        background: #f8f9fc;
    }

    .dimension-name {
        font-weight: 600;
        color: #1e293b;
    }

    .metric-value {
        font-weight: 600;
        color: #4c6ef5;
    }

    .note-text {
        background: #f8f9fc;
        padding: 1rem;
        border-radius: 8px;
        border-left: 4px solid #4c6ef5;
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 1rem;
    }

    .note-text i {
        color: #4c6ef5;
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .detail-header h2 {
            font-size: 1.25rem;
        }

        .info-card-header {
            padding: 1rem;
        }

        .info-card-body {
            padding: 1rem;
        }

        .info-table th {
            width: 140px;
            font-size: 0.875rem;
        }

        .info-table td {
            font-size: 0.875rem;
        }

        .action-buttons-group {
            flex-direction: column;
        }

        .btn-action-detail {
            width: 100%;
            justify-content: center;
        }

        .summary-table {
            font-size: 0.875rem;
        }

        .summary-table thead th,
        .summary-table tbody td {
            padding: 0.75rem 0.5rem;
        }
    }
</style>

<div class="page-content">
    <div class="detail-header">
        <h2>
            <i class="bi bi-eye"></i>
            Detail Survei
        </h2>
    </div>

    <div class="info-card">
        <div class="info-card-header">
            <h5>
                <i class="bi bi-info-circle"></i>
                Informasi Survei
            </h5>
        </div>
        <div class="info-card-body">
            <table class="info-table table table-borderless">
              
                <tr>
                    <th>Judul</th>
                    <td>
                        <span class="info-label">:</span>
                        <?= htmlspecialchars($survei['judul_survei']); ?>
                    </td>
                </tr>
                <tr>
                    <th>Periode</th>
                    <td>
                        <span class="info-label">:</span>
                        <div class="periode-info d-inline-flex">
                            <i class="bi bi-calendar-range"></i>
                            <span>
                                <?= date('d M Y H:i', strtotime($survei['tanggal_mulai'])) ?>
                                —
                                <?= date('d M Y H:i', strtotime($survei['tanggal_selesai'])) ?>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="info-label">:</span>
                        <span class="badge status-badge bg-<?= $survei['status'] === 'berjalan' ? 'success' : ($survei['status'] === 'selesai' ? 'dark' : 'secondary') ?>">
                            <?= htmlspecialchars(strtoupper($survei['status'])) ?>
                        </span>
                    </td>
                </tr>
                <?php if (!empty($survei['deskripsi'])): ?>
                    <tr>
                        <th>Deskripsi</th>
                        <td>
                            <span class="info-label">:</span>
                            <?= nl2br(htmlspecialchars($survei['deskripsi'])); ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>

            <div class="action-buttons-group">
                <a href="/sertifikasi-latihan3/survei" class="btn-action-detail btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
                <a href="/sertifikasi-latihan3/survei-edit?id_survei=<?= $survei['id_survei'] ?>" class="btn-action-detail btn-edit">
                    <i class="bi bi-pencil"></i>
                    Edit
                </a>
                <a href="/sertifikasi-latihan3/mapping?id_survei=<?= $survei['id_survei'] ?>" class="btn-action-detail btn-mapping">
                    <i class="bi bi-link-45deg"></i>
                    Mapping Butir
                </a>
                <a href="/sertifikasi-latihan3/hasil?id_survei=<?= $survei['id_survei'] ?>" class="btn-action-detail btn-result">
                    <i class="bi bi-graph-up"></i>
                    Hasil WQI
                </a>
            </div>
        </div>
    </div>

    <?php if (!empty($ringkas)): ?>
        <div class="info-card">
            <div class="info-card-header">
                <h5>
                    <i class="bi bi-bar-chart-line"></i>
                    Ringkasan Hasil
                </h5>
            </div>
            <div class="info-card-body">
                <div class="table-responsive">
                    <table class="summary-table table">
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
                                    <td>
                                        <span class="dimension-name"><?= htmlspecialchars($r['nama_dimensi']); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="metric-value"><?= htmlspecialchars($r['rata_harapan']); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="metric-value"><?= htmlspecialchars($r['rata_jawaban']); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="metric-value"><?= htmlspecialchars($r['wqi_unit']); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="note-text">
                    <i class="bi bi-info-circle"></i>
                    <strong>Catatan:</strong> WQI (unit) = AVG(harapan×penilaian) / (AVG(harapan) × 5)
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>