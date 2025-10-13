<div id="indexPage" class="page-content active">
    <div class="row mb-3">
        <div class="col d-flex justify-content-between align-items-center">
            <h3><i class="fas fa-table"></i> Data Lowongan</h3>
            <a href="lowongan-create" class="btn btn-gradient">
                <i class="fas fa-plus"></i> Tambah Lowongan
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
                            <th>ID</th>
                            <th>Nama Perusahaan</th>
                            <th>Posisi</th>
                            <th>Lokasi</th>
                            <th>Tanggal Kadaluarsa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lowongans as $l): ?>
                            <tr>
                                <td><?= htmlspecialchars($l['id']); ?></td>
                                <td><?= htmlspecialchars($l['nama_perusahaan']); ?></td>
                                <td><?= htmlspecialchars($l['posisi']); ?></td>
                                <td><?= htmlspecialchars($l['lokasi']); ?></td>
                                <td><?= htmlspecialchars($l['tanggal_kadaluarsa']); ?></td>
                                <td>
                                    <a href="lowongan-show?id=<?= $l['id'] ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="lowongan-edit?id=<?= $l['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <button onclick="deleteData('<?= $l['id'] ?>')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
    function deleteData(id) {
        if (confirm('Yakin ingin menghapus lowongan ini?')) {
            $.post('lowongan-delete', {
                id: id
            }, function(response) {
                window.location.reload();
            });
        }
    }
</script>