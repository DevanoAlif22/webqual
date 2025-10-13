<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-edit"></i> Edit Lowongan</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color: black;"><i class="fas fa-briefcase"></i> Form Edit Lowongan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $lowongan['id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Perusahaan *</label>
                    <input type="text" name="nama_perusahaan" class="form-control" value="<?= htmlspecialchars($lowongan['nama_perusahaan']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Posisi *</label>
                    <input type="text" name="posisi" class="form-control" value="<?= htmlspecialchars($lowongan['posisi']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi *</label>
                    <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($lowongan['lokasi']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi *</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($lowongan['deskripsi']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kualifikasi *</label>
                    <textarea name="kualifikasi" class="form-control" rows="3" required><?= htmlspecialchars($lowongan['kualifikasi']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kadaluarsa *</label>
                    <input type="date" name="tanggal_kadaluarsa" class="form-control" value="<?= $lowongan['tanggal_kadaluarsa']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kontak *</label>
                    <input type="text" name="kontak" class="form-control" value="<?= htmlspecialchars($lowongan['kontak']); ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient"><i class="fas fa-save"></i> Update</button>
                    <a href="lowongan" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>