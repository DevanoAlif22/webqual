<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-eye"></i> Detail Lowongan</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color: black;"><i class="fas fa-briefcase"></i> Informasi Lowongan</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>ID</th>
                    <td>: <?= htmlspecialchars($lowongan['id']); ?></td>
                </tr>
                <tr>
                    <th>Nama Perusahaan</th>
                    <td>: <?= htmlspecialchars($lowongan['nama_perusahaan']); ?></td>
                </tr>
                <tr>
                    <th>Posisi</th>
                    <td>: <?= htmlspecialchars($lowongan['posisi']); ?></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>: <?= htmlspecialchars($lowongan['lokasi']); ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>: <?= nl2br(htmlspecialchars($lowongan['deskripsi'])); ?></td>
                </tr>
                <tr>
                    <th>Kualifikasi</th>
                    <td>: <?= nl2br(htmlspecialchars($lowongan['kualifikasi'])); ?></td>
                </tr>
                <tr>
                    <th>Tanggal Kadaluarsa</th>
                    <td>: <?= htmlspecialchars($lowongan['tanggal_kadaluarsa']); ?></td>
                </tr>
                <tr>
                    <th>Kontak</th>
                    <td>: <?= htmlspecialchars($lowongan['kontak']); ?></td>
                </tr>
            </table>

            <hr>

            <a href="lowongan" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>