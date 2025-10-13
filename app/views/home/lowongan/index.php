<style>
    .page-header {
        margin-bottom: 1.5rem;
    }

    .page-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.5rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .page-header h2 i {
        color: #64748b;
        font-size: 1.4rem;
    }

    .btn-add-lowongan {
        background: #4c6ef5;
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        box-shadow: 0 2px 4px rgba(76, 110, 245, 0.2);
        text-decoration: none;
    }

    .btn-add-lowongan:hover {
        background: #3b5bdb;
        box-shadow: 0 4px 12px rgba(76, 110, 245, 0.3);
        color: white;
    }

    .card-modern {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .card-modern .card-body {
        padding: 0;
    }

    .table-modern {
        margin: 0;
    }

    .table-modern thead {
        background: #f8f9fc;
    }

    .table-modern thead th {
        border: none;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
    }

    .table-modern tbody tr {
        transition: background-color 0.2s;
        border-bottom: 1px solid #f1f5f9;
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody tr:hover {
        background: #f8f9fc;
    }

    .table-modern tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border: none;
    }

    .lowongan-no {
        font-weight: 700;
        color: #4c6ef5;
        font-size: 1rem;
    }

    .company-name {
        color: #1e293b;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .position-name {
        color: #475569;
        font-size: 0.95rem;
    }

    .location-info {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.9rem;
    }

    .location-info i {
        color: #94a3b8;
    }

    .expire-date {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.9rem;
    }

    .expire-date i {
        color: #94a3b8;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-action {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: none;
        transition: all 0.3s;
        font-size: 0.95rem;
    }

    .btn-action:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-action.btn-view {
        background: #eff6ff;
        color: #3b82f6;
    }

    .btn-action.btn-view:hover {
        background: #3b82f6;
        color: white;
    }

    .btn-action.btn-edit {
        background: #fffbeb;
        color: #f59e0b;
    }

    .btn-action.btn-edit:hover {
        background: #f59e0b;
        color: white;
    }

    .btn-action.btn-delete {
        background: #fef2f2;
        color: #ef4444;
    }

    .btn-action.btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        color: #64748b;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 1.5rem;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }

    .pagination-info {
        color: #64748b;
        font-size: 0.9rem;
    }

    .pagination-controls {
        display: flex;
        gap: 0.5rem;
    }

    .pagination-btn {
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        background: white;
        color: #64748b;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pagination-btn:hover:not(:disabled) {
        background: #f8f9fc;
        border-color: #4c6ef5;
        color: #4c6ef5;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-btn.active {
        background: #4c6ef5;
        color: white;
        border-color: #4c6ef5;
    }

    .page-number-btn {
        width: 38px;
        height: 38px;
        padding: 0;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }

        .page-header h2 {
            font-size: 1.25rem;
        }

        .btn-add-lowongan {
            width: 100%;
            justify-content: center;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 1rem;
            font-size: 0.875rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
        }
    }
</style>

<div id="indexPage" class="page-content active">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="page-header">
            <h2>
                <i class="bi bi-briefcase"></i>
                Data Lowongan
            </h2>
        </div>
        <a href="lowongan-create" class="btn btn-add-lowongan">
            <i class="bi bi-plus-circle"></i>
            Tambah Lowongan
        </a>
    </div>

    <div class="card-modern">
        <div class="card-body">
            <?php if (isset($_SESSION['alertSuccess'])): ?>
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= htmlspecialchars($_SESSION['alertSuccess']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['alertSuccess']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['alertError'])): ?>
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <?= htmlspecialchars($_SESSION['alertError']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['alertError']); ?>
            <?php endif; ?>

            <?php if (empty($lowongans)): ?>
                <div class="empty-state">
                    <i class="bi bi-briefcase"></i>
                    <h4>Belum Ada Lowongan</h4>
                    <p>Mulai tambahkan lowongan pekerjaan untuk kandidat</p>
                    <a href="lowongan-create" class="btn btn-add-lowongan">
                        <i class="bi bi-plus-circle"></i>
                        Buat Lowongan Pertama
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th style="width: 240px;">Nama Perusahaan</th>
                                <th style="width: 220px;">Posisi</th>
                                <th style="width: 200px;">Lokasi</th>
                                <th style="width: 180px;">Tanggal Kadaluarsa</th>
                                <th style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($lowongans as $l): ?>
                                <tr>
                                    <td>
                                        <span class="lowongan-no"><?= $no++; ?></span>
                                    </td>
                                    <td>
                                        <div class="company-name"><?= htmlspecialchars($l['nama_perusahaan']); ?></div>
                                    </td>
                                    <td>
                                        <div class="position-name"><?= htmlspecialchars($l['posisi']); ?></div>
                                    </td>
                                    <td>
                                        <div class="location-info">
                                            <i class="bi bi-geo-alt"></i>
                                            <span><?= htmlspecialchars($l['lokasi']); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="expire-date">
                                            <i class="bi bi-calendar-x"></i>
                                            <span><?= htmlspecialchars($l['tanggal_kadaluarsa']); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="lowongan-show?id=<?= $l['id'] ?>" 
                                               class="btn btn-action btn-view" 
                                               title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="lowongan-edit?id=<?= $l['id'] ?>" 
                                               class="btn btn-action btn-edit"
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button onclick="deleteData('<?= $l['id'] ?>')" 
                                                    class="btn btn-action btn-delete"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function deleteData(id) {
        if (confirm('Yakin ingin menghapus lowongan ini?\n\nTindakan ini tidak dapat dibatalkan.')) {
            // Show loading state
            const btn = event.target.closest('button');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i>';
            btn.disabled = true;

            $.post('lowongan-delete', {
                id: id
            }, function(response) {
                alert('✓ Lowongan berhasil dihapus!');
                window.location.reload();
            }).fail(function() {
                alert('✗ Terjadi kesalahan. Silakan coba lagi.');
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            });
        }
    }
</script>