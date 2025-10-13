<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-eye"></i> Detail Dimensi</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color: black;"><i class="fas fa-diagram-project"></i> Informasi Dimensi</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width:220px;">ID Dimensi</th>
                    <td>: <?= (int)$dimensi['id_dimensi']; ?></td>
                </tr>
                <tr>
                    <th>Kode Dimensi</th>
                    <td>: <code><?= htmlspecialchars($dimensi['kode_dimensi']); ?></code></td>
                </tr>
                <tr>
                    <th>Nama Dimensi</th>
                    <td>: <?= htmlspecialchars($dimensi['nama_dimensi']); ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>: <?= nl2br(htmlspecialchars($dimensi['deskripsi'] ?? '-')); ?></td>
                </tr>
            </table>

            <hr>

            <a href="/sertifikasi-latihan3/dimensi" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <a href="/sertifikasi-latihan3/dimensi-edit?id_dimensi=<?= $dimensi['id_dimensi'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        </div>
    </div>
</div>