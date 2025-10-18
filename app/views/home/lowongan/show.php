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
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
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

    .highlight-text {
        background: #f8fafc;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        color: #334155;
        border-left: 4px solid #4c6ef5;
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
            <i class="bi bi-briefcase"></i>
            Detail Lowongan
        </h2>
    </div>

    <div class="info-card">
        <div class="info-card-header">
            <h5><i class="bi bi-info-circle"></i> Informasi Lowongan</h5>
        </div>
        <div class="info-card-body">
            <table class="info-table table table-borderless">
                <tr>
                    <th>ID</th>
                    <td><strong>#<?= htmlspecialchars($lowongan['id']); ?></strong></td>
                </tr>
                <tr>
                    <th>Nama Perusahaan</th>
                    <td><?= htmlspecialchars($lowongan['nama_perusahaan']); ?></td>
                </tr>
                <tr>
                    <th>Posisi</th>
                    <td><?= htmlspecialchars($lowongan['posisi']); ?></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><?= htmlspecialchars($lowongan['lokasi']); ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><div class="highlight-text"><?= nl2br(htmlspecialchars($lowongan['deskripsi'])); ?></div></td>
                </tr>
                <tr>
                    <th>Kualifikasi</th>
                    <td><div class="highlight-text"><?= nl2br(htmlspecialchars($lowongan['kualifikasi'])); ?></div></td>
                </tr>
                <tr>
                    <th>Tanggal Kadaluarsa</th>
                    <td><?= htmlspecialchars($lowongan['tanggal_kadaluarsa']); ?></td>
                </tr>
                <tr>
                    <th>Kontak</th>
                    <td><?= htmlspecialchars($lowongan['kontak']); ?></td>
                </tr>
            </table>

            <div class="mt-4 d-flex gap-2 flex-wrap">
                <a href="lowongan" class="btn-action-detail btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
