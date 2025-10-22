<style>
    .page-header {
        margin-bottom: 1.5rem
    }

    .page-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.5rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: .5rem
    }

    .page-header h2 i {
        color: #64748b;
        font-size: 1.4rem
    }

    .card-modern {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .08);
        border: none;
        overflow: hidden
    }

    .card-modern .card-body {
        padding: 0
    }

    .table-modern {
        margin: 0
    }

    .table-modern thead {
        background: #f8f9fc
    }

    .table-modern thead th {
        border: none;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        font-size: .85rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #64748b
    }

    .table-modern tbody tr {
        transition: background-color .2s;
        border-bottom: 1px solid #f1f5f9
    }

    .table-modern tbody tr:last-child {
        border-bottom: none
    }

    .table-modern tbody tr:hover {
        background: #f8f9fc
    }

    .table-modern tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border: none
    }

    .resp-no {
        font-weight: 700;
        color: #4c6ef5;
        font-size: 1rem
    }

    .badge-kelamin {
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 6px;
        padding: .25rem .5rem;
        font-weight: 600
    }

    .badge-umur {
        background: #f1f5f9;
        color: #334155;
        border-radius: 6px;
        padding: .25rem .5rem;
        font-weight: 600
    }

    .action-buttons {
        display: flex;
        gap: .5rem;
        flex-wrap: wrap
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
        transition: .3s;
        font-size: .95rem
    }

    .btn-action:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, .15)
    }

    .btn-view {
        background: #eff6ff;
        color: #3b82f6
    }

    .btn-view:hover {
        background: #3b82f6;
        color: #fff
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1rem
    }

    .empty-state h4 {
        color: #64748b;
        font-weight: 600;
        margin-bottom: .5rem
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 1.5rem
    }

    .toolbar {
        display: flex;
        gap: .75rem;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        flex-wrap: wrap
    }

    .toolbar .form-control,
    .toolbar .form-select {
        max-width: 260px
    }

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-top: 1px solid #f1f5f9
    }

    .pagination-info {
        color: #64748b;
        font-size: .9rem
    }

    .pagination-controls {
        display: flex;
        gap: .5rem
    }

    .pagination-btn {
        padding: .5rem 1rem;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        border-radius: 8px;
        font-weight: 600;
        font-size: .875rem;
        cursor: pointer;
        transition: .3s;
        display: inline-flex;
        align-items: center;
        gap: .5rem
    }

    .pagination-btn:hover:not(:disabled) {
        background: #f8f9fc;
        border-color: #4c6ef5;
        color: #4c6ef5
    }

    .pagination-btn:disabled {
        opacity: .5;
        cursor: not-allowed
    }

    .pagination-btn.active {
        background: #4c6ef5;
        color: #fff;
        border-color: #4c6ef5
    }

    .page-number-btn {
        width: 38px;
        height: 38px;
        padding: 0;
        justify-content: center
    }

    @media(max-width:768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem
        }

        .page-header h2 {
            font-size: 1.25rem
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 1rem;
            font-size: .875rem
        }

        .action-buttons {
            flex-direction: column
        }

        .btn-action {
            width: 100%
        }

        .toolbar {
            flex-direction: column;
            align-items: stretch
        }

        .toolbar .form-control,
        .toolbar .form-select {
            max-width: 100%
        }

        .pagination-wrapper {
            flex-direction: column;
            gap: 1rem;
            padding: 1rem
        }

        .pagination-controls {
            width: 100%;
            flex-wrap: wrap;
            justify-content: center
        }

        .pagination-btn {
            font-size: .8rem;
            padding: .4rem .8rem
        }
    }
</style>

<div id="indexPage" class="page-content active">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="page-header">
            <h2><i class="bi bi-people"></i> Data Responden</h2>
        </div>
        <!-- bisa tambah tombol export jika dibutuhkan -->
    </div>

    <div class="card-modern">
        <div class="card-body">
            <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
            <?php if (!empty($_SESSION['alertSuccess'])): ?>
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($_SESSION['alertSuccess']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['alertSuccess']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['alertError'])): ?>
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($_SESSION['alertError']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['alertError']); ?>
            <?php endif; ?>

            <div class="toolbar">
                <input type="text" id="qSearch" class="form-control" placeholder="Cari nama atau email...">
                <select id="qKelamin" class="form-select">
                    <option value="">Semua Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <input type="date" id="qTanggal" class="form-control" title="Filter tanggal kirim">
                <button class="btn btn-outline-secondary" id="btnReset">Reset</button>
            </div>

            <?php if (empty($responden)): ?>
                <div class="empty-state">
                    <i class="bi bi-people"></i>
                    <h4>Belum Ada Responden</h4>
                    <p>Data responden akan muncul setelah ada pengisian survei.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th style="width:80px;">No</th>
                                <th style="width:220px;">Nama</th>
                                <th style="width:260px;">Email</th>
                                <th style="width:140px;">Jenis Kelamin</th>
                                <th style="width:100px;">Umur</th>
                                <th style="width:200px;">Jurusan/Asal</th>
                                <th style="width:200px;">Waktu Kirim</th>
                                <th style="width:120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyResponden">
                            <?php $no = 1;
                            foreach ($responden as $r): ?>
                                <tr data-nama="<?= htmlspecialchars(mb_strtolower($r['nama'])) ?>"
                                    data-email="<?= htmlspecialchars(mb_strtolower($r['email'])) ?>"
                                    data-kelamin="<?= htmlspecialchars($r['jenis_kelamin']) ?>"
                                    data-tanggal="<?= htmlspecialchars(substr($r['dibuat_pada'], 0, 10)) ?>">
                                    <td><span class="resp-no"><?= $no++; ?></span></td>
                                    <td><strong><?= htmlspecialchars($r['nama']); ?></strong></td>
                                    <td><?= htmlspecialchars($r['email']); ?></td>
                                    <td><span class="badge-kelamin"><?= htmlspecialchars($r['jenis_kelamin']); ?></span></td>
                                    <td><span class="badge-umur"><?= (int)$r['umur']; ?></span></td>
                                    <td><?= htmlspecialchars($r['jurusan']); ?></td>
                                    <td><small class="text-muted"><?= date('d M Y H:i', strtotime($r['dibuat_pada'])); ?></small></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/webqual/admin/responden-show?id_responden=<?= (int)$r['id_responden'] ?>"
                                                class="btn-action btn-view" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Menampilkan <strong id="showingStart">1</strong> - <strong id="showingEnd">5</strong> dari <strong id="totalData">0</strong> data
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" id="prevBtn" onclick="changePage(-1)"><i class="bi bi-chevron-left"></i> Sebelumnya</button>
                        <div id="pageNumbers"></div>
                        <button class="pagination-btn" id="nextBtn" onclick="changePage(1)">Berikutnya <i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    let currentPage = 1,
        itemsPerPage = 5,
        allRows = [];
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('tbodyResponden');
        if (!tbody) return;
        allRows = [...tbody.querySelectorAll('tr')];
        applyFilter(); // init + paginate
        document.getElementById('qSearch').addEventListener('input', applyFilter);
        document.getElementById('qKelamin').addEventListener('change', applyFilter);
        document.getElementById('qTanggal').addEventListener('change', applyFilter);
        document.getElementById('btnReset').addEventListener('click', () => {
            document.getElementById('qSearch').value = '';
            document.getElementById('qKelamin').value = '';
            document.getElementById('qTanggal').value = '';
            applyFilter();
        });
    });

    function applyFilter() {
        const q = (document.getElementById('qSearch').value || '').trim().toLowerCase();
        const kel = document.getElementById('qKelamin').value || '';
        const tgl = document.getElementById('qTanggal').value || '';
        allRows.forEach(tr => {
            const nama = tr.dataset.nama || '';
            const email = tr.dataset.email || '';
            const jk = tr.dataset.kelamin || '';
            const d = tr.dataset.tanggal || '';
            let show = true;
            if (q && !(nama.includes(q) || email.includes(q))) show = false;
            if (kel && jk !== kel) show = false;
            if (tgl && d !== tgl) show = false;
            tr.style.display = show ? '' : 'none';
        });
        // Recollect visible rows for pagination
        const visibleRows = allRows.filter(tr => tr.style.display !== 'none');
        paginate(visibleRows, 1);
    }

    function paginate(rows, page) {
        currentPage = page;
        const start = (page - 1) * itemsPerPage,
            end = start + itemsPerPage;
        // hide all visible first
        rows.forEach(r => r.style.visibility = 'hidden');
        rows.slice(start, end).forEach(r => r.style.visibility = 'visible');
        // renumber only visible slice
        rows.slice(start, end).forEach((row, idx) => {
            const cell = row.querySelector('.resp-no');
            if (cell) cell.textContent = start + idx + 1;
        });
        // info
        document.getElementById('showingStart').textContent = rows.length ? start + 1 : 0;
        document.getElementById('showingEnd').textContent = Math.min(end, rows.length);
        document.getElementById('totalData').textContent = rows.length;
        updatePaginationButtons(rows.length);
    }

    function updatePaginationButtons(totalItems) {
        const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages;
        const wrap = document.getElementById('pageNumbers');
        wrap.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.className = 'pagination-btn page-number-btn' + (i === currentPage ? ' active' : '');
            btn.textContent = i;
            btn.onclick = () => changeTo(i);
            wrap.appendChild(btn);
        }
    }

    function changeTo(i) {
        const rows = [...document.querySelectorAll('#tbodyResponden tr')].filter(tr => tr.style.display !== 'none');
        paginate(rows, i);
    }

    function changePage(delta) {
        const rows = [...document.querySelectorAll('#tbodyResponden tr')].filter(tr => tr.style.display !== 'none');
        const totalPages = Math.max(1, Math.ceil(rows.length / itemsPerPage));
        const next = currentPage + delta;
        if (next >= 1 && next <= totalPages) paginate(rows, next);
    }
</script>