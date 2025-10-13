<?php
// Variabel dari controller: $surveis (list), opsional $running, $totalResponPerSurvei = [id_survei => total]
function badgeStatus($s)
{
    $map = ['draf' => 'secondary', 'berjalan' => 'success', 'selesai' => 'dark'];
    $cls = $map[$s] ?? 'secondary';
    return '<span class="badge bg-' . $cls . ' text-uppercase">' . $s . '</span>';
}
?>
<div id="indexPage" class="page-content active">
    <div class="row mb-3">
        <div class="col d-flex justify-content-between align-items-center">
            <h3><i class="fas fa-table"></i> Data Survei</h3>
            <a href="/webqual/admin/survei-create" class="btn btn-gradient">
                <i class="fas fa-plus"></i> Tambah Survei
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
                            <th>Judul</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Respon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($surveis as $s): ?>
                            <?php
                            $periode = date('d M Y H:i', strtotime($s['tanggal_mulai'])) . ' — ' . date('d M Y H:i', strtotime($s['tanggal_selesai']));
                            $respon = $totalResponPerSurvei[$s['id_survei']] ?? '-';
                            ?>
                            <tr>
                                <td><?= (int)$s['id_survei']; ?></td>
                                <td><?= htmlspecialchars($s['judul_survei']); ?></td>
                                <td><small class="text-muted"><?= $periode; ?></small></td>
                                <td><?= badgeStatus($s['status']); ?></td>
                                <td><?= htmlspecialchars($respon); ?></td>
                                <td class="d-flex gap-1">
                                    <a href="/webqual/admin/survei-show?id_survei=<?= $s['id_survei'] ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/webqual/admin/survei-edit?id_survei=<?= $s['id_survei'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/webqual/admin/mapping?id_survei=<?= $s['id_survei'] ?>" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    <a href="/webqual/admin/hasil?id_survei=<?= $s['id_survei'] ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-chart-line"></i>
                                    </a>
                                    <button onclick="deleteSurvei('<?= (int)$s['id_survei'] ?>')" class="btn btn-sm btn-danger">
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
    function deleteSurvei(id) {
        if (confirm('Yakin ingin menghapus survei ini? Tindakan tidak dapat dibatalkan.')) {
            $.post('/webqual/admin/survei/delete', {
                id_survei: id
            }, function(resp) {
                try {
                    var j = JSON.parse(resp);
                } catch (e) {
                    j = {
                        status: 'error'
                    };
                }
                if (j.status === 'success') window.location.reload();
                else alert('Gagal menghapus survei.');
            });
        }
    }
</script>