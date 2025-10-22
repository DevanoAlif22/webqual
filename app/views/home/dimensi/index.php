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

    .btn-add-dimensi {
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

    .btn-add-dimensi:hover {
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

    .dimensi-no {
        font-weight: 700;
        color: #4c6ef5;
        font-size: 1rem;
    }

    .dimensi-code {
        background: #f1f5f9;
        color: #475569;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-block;
    }

    .dimensi-name {
        color: #1e293b;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .dimensi-desc {
        color: #64748b;
        font-size: 0.875rem;
        line-height: 1.5;
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

        .btn-add-dimensi {
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

        .pagination-wrapper {
            flex-direction: column;
            gap: 1rem;
            padding: 1rem;
        }

        .pagination-controls {
            width: 100%;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-btn {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }
    }
</style>

<div id="indexPage" class="page-content active">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="page-header">
            <h2>
                <i class="bi bi-diagram-3"></i>
                Data Dimensi
            </h2>
        </div>
        <a href="/webqual/admin/dimensi-create" class="btn btn-add-dimensi">
            <i class="bi bi-plus-circle"></i>
            Tambah Dimensi
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

            <?php if (empty($dimensis)): ?>
                <div class="empty-state">
                    <i class="bi bi-diagram-3"></i>
                    <h4>Belum Ada Dimensi</h4>
                    <p>Mulai buat dimensi untuk mengelompokkan pertanyaan survei</p>
                    <a href="/webqual/admin/dimensi-create" class="btn btn-add-dimensi">
                        <i class="bi bi-plus-circle"></i>
                        Buat Dimensi Pertama
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th style="width: 160px;">Kode</th>
                                <th style="width: 280px;">Nama Dimensi</th>
                                <th>Deskripsi</th>
                                <th style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dimensis as $d): ?>
                                <tr>
                                    <td>
                                        <span class="dimensi-no"><?= $no++; ?></span>
                                    </td>
                                    <td>
                                        <span class="dimensi-code"><?= htmlspecialchars($d['kode_dimensi']); ?></span>
                                    </td>
                                    <td>
                                        <div class="dimensi-name"><?= htmlspecialchars($d['nama_dimensi']); ?></div>
                                    </td>
                                    <td>
                                        <div class="dimensi-desc">
                                            <?= htmlspecialchars(mb_strimwidth($d['keterangan'] ?? '-', 0, 80, '...')); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/webqual/admin/dimensi-show?id_dimensi=<?= $d['id_dimensi'] ?>"
                                                class="btn btn-action btn-view"
                                                title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="/webqual/admin/dimensi-edit?id_dimensi=<?= $d['id_dimensi'] ?>"
                                                class="btn btn-action btn-edit"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button onclick="deleteDimensi('<?= (int)$d['id_dimensi'] ?>')"
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

                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Menampilkan <strong id="showingStart">1</strong> - <strong id="showingEnd">5</strong> dari <strong id="totalData"><?= count($dimensis); ?></strong> data
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)">
                            <i class="bi bi-chevron-left"></i>
                            Sebelumnya
                        </button>
                        <div id="pageNumbers"></div>
                        <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">
                            Berikutnya
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Pagination variables
    let currentPage = 1;
    const itemsPerPage = 5;
    let allRows = [];

    // Initialize pagination on page load
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.querySelector('.table-modern tbody');
        if (tbody) {
            allRows = Array.from(tbody.querySelectorAll('tr'));
            showPage(1);
        }
    });

    function showPage(page) {
        currentPage = page;
        const tbody = document.querySelector('.table-modern tbody');
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        // Hide all rows
        allRows.forEach(row => row.style.display = 'none');

        // Show only rows for current page
        const pageRows = allRows.slice(start, end);
        pageRows.forEach(row => row.style.display = '');

        // Update row numbers
        pageRows.forEach((row, index) => {
            const numberCell = row.querySelector('.dimensi-no');
            if (numberCell) {
                numberCell.textContent = start + index + 1;
            }
        });

        // Update pagination info
        document.getElementById('showingStart').textContent = start + 1;
        document.getElementById('showingEnd').textContent = Math.min(end, allRows.length);
        document.getElementById('totalData').textContent = allRows.length;

        // Update buttons
        updatePaginationButtons();
    }

    function updatePaginationButtons() {
        const totalPages = Math.ceil(allRows.length / itemsPerPage);

        // Update prev/next buttons
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages;

        // Generate page number buttons
        const pageNumbersDiv = document.getElementById('pageNumbers');
        pageNumbersDiv.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.className = 'pagination-btn page-number-btn' + (i === currentPage ? ' active' : '');
            btn.textContent = i;
            btn.onclick = () => showPage(i);
            pageNumbersDiv.appendChild(btn);
        }
    }

    function changePage(direction) {
        const totalPages = Math.ceil(allRows.length / itemsPerPage);
        const newPage = currentPage + direction;

        if (newPage >= 1 && newPage <= totalPages) {
            showPage(newPage);
        }
    }

    function deleteDimensi(id) {
        if (confirm('Yakin ingin menghapus dimensi ini?\n\nPastikan dimensi tidak sedang dipakai pada pertanyaan atau survei.')) {
            // Show loading state
            const btn = event.target.closest('button');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i>';
            btn.disabled = true;

            $.post('/webqual/admin/dimensi/delete', {
                id_dimensi: id
            }, function(resp) {
                try {
                    var j = JSON.parse(resp);
                } catch (e) {
                    j = {
                        status: 'error'
                    };
                }
                if (j.status === 'success') {
                    alert('✓ Dimensi berhasil dihapus!');
                    window.location.reload();
                } else {
                    alert('✗ Gagal menghapus dimensi.\nPastikan tidak sedang dipakai pada pertanyaan/survei.');
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }
            }).fail(function() {
                alert('✗ Terjadi kesalahan. Silakan coba lagi.');
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            });
        }
    }
</script>