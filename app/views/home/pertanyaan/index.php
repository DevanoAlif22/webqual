<?php
// Jika controller juga mengirim $dimensis, kita buat map id_dimensi => nama_dimensi
$mapDim = [];
if (!empty($dimensis)) {
    foreach ($dimensis as $d) $mapDim[(int)$d['id_dimensi']] = $d['nama_dimensi'];
}
function badgeAktif($a)
{
    return (int)$a === 1
        ? '<span class="badge bg-success">Aktif</span>'
        : '<span class="badge bg-secondary">Nonaktif</span>';
}
?>
<div id="indexPage" class="page-content active">
    <div class="row mb-3">
        <div class="col d-flex justify-content-between align-items-center">
            <h3><i class="fas fa-table"></i> Data Pertanyaan</h3>
            <a href="/webqual/admin/pertanyaan-create" class="btn btn-gradient">
                <i class="fas fa-plus"></i> Tambah Pertanyaan
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
                            <th style="width:8%;">ID</th>
                            <th style="width:14%;">Kode</th>
                            <th style="width:28%;">Pernyataan</th>
                            <th style="width:22%;">Dimensi</th>
                            <th style="width:10%;">Status</th>
                            <th style="width:18%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pertanyaans as $p): ?>
                            <tr>
                                <td><?= (int)$p['id_pertanyaan']; ?></td>
                                <td><code><?= htmlspecialchars($p['kode_pertanyaan']); ?></code></td>
                                <td><?= htmlspecialchars(mb_strimwidth($p['teks_pertanyaan'], 0, 70, '...')); ?></td>
                                <td><?= htmlspecialchars($p['nama_dimensi'] ?? ($mapDim[(int)$p['id_dimensi']] ?? '-')); ?></td>
                                <td><?= badgeAktif($p['aktif']); ?></td>
                                <td class="d-flex gap-1">
                                    <a href="/webqual/admin/pertanyaan-show?id_pertanyaan=<?= $p['id_pertanyaan'] ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/webqual/admin/pertanyaan-edit?id_pertanyaan=<?= $p['id_pertanyaan'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deletePertanyaan('<?= (int)$p['id_pertanyaan'] ?>')" class="btn btn-sm btn-danger">
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
    function deletePertanyaan(id) {
        if (confirm('Yakin ingin menghapus pertanyaan ini? Pastikan tidak sedang dipakai di Survei.')) {
            $.post('/webqual/admin/pertanyaan/delete', {
                id_pertanyaan: id
            }, function(resp) {
                try {
                    var j = JSON.parse(resp);
                } catch (e) {
                    j = {
                        status: 'error'
                    };
                }
                if (j.status === 'success') window.location.reload();
                else alert('Gagal menghapus pertanyaan. Mungkin sedang dipakai di Survei.');
            });
        }
    }
</script>