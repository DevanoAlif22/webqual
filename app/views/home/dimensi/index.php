<div id="indexPage" class="page-content active">
    <div class="row mb-3">
        <div class="col d-flex justify-content-between align-items-center">
            <h3><i class="fas fa-table"></i> Data Dimensi</h3>
            <a href="/webqual/admin/dimensi-create" class="btn btn-gradient">
                <i class="fas fa-plus"></i> Tambah Dimensi
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (isset($_SESSION['alertSuccess'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['alertSuccess']); ?></div>
                <?php unset($_SESSION['alertSuccess']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['alertError'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['alertError']); ?></div>
                <?php unset($_SESSION['alertError']); ?>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:10%;">ID</th>
                            <th style="width:20%;">Kode</th>
                            <th style="width:30%;">Nama Dimensi</th>
                            <th style="width:25%;">Deskripsi</th>
                            <th style="width:15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dimensis as $d): ?>
                            <tr>
                                <td><?= (int)$d['id_dimensi']; ?></td>
                                <td><code><?= htmlspecialchars($d['kode_dimensi']); ?></code></td>
                                <td><?= htmlspecialchars($d['nama_dimensi']); ?></td>
                                <td>
                                    <small class="text-muted">
                                        <?= htmlspecialchars(mb_strimwidth($d['deskripsi'] ?? '-', 0, 60, '...')); ?>
                                    </small>
                                </td>
                                <td class="d-flex gap-1">
                                    <a href="/webqual/admin/dimensi-show?id_dimensi=<?= $d['id_dimensi'] ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/webqual/admin/dimensi-edit?id_dimensi=<?= $d['id_dimensi'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteDimensi('<?= (int)$d['id_dimensi'] ?>')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function deleteDimensi(id) {
        if (confirm('Yakin ingin menghapus dimensi ini?')) {
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
                if (j.status === 'success') window.location.reload();
                else alert('Gagal menghapus dimensi. Pastikan tidak sedang dipakai pada Pertanyaan/Survei.');
            });
        }
    }
</script>