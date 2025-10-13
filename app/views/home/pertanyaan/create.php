<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-plus"></i> Tambah Pertanyaan</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color: black;"><i class="fas fa-question-circle"></i> Form Tambah Pertanyaan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/sertifikasi-latihan3/pertanyaan/store">
                <div class="mb-3">
                    <label class="form-label">Dimensi *</label>
                    <select name="id_dimensi" class="form-control" required>
                        <option value="">-- Pilih Dimensi --</option>
                        <?php foreach ($dimensis as $d): ?>
                            <option value="<?= (int)$d['id_dimensi']; ?>">
                                <?= htmlspecialchars($d['nama_dimensi']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Pertanyaan *</label>
                    <input type="text" name="kode_pertanyaan" class="form-control" placeholder="misal: US1 / IN2 / SI3" required>
                    <small class="text-muted">Gunakan kode unik per butir (contoh: US1, IN2, SI3).</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teks Pertanyaan / Indikator *</label>
                    <textarea name="teks_pertanyaan" class="form-control" rows="4" placeholder="Tulis pernyataan butir di sini..." required></textarea>
                </div>

                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="aktifSwitch" name="aktif" value="1" checked>
                    <label class="form-check-label" for="aktifSwitch">Aktif</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient"><i class="fas fa-save"></i> Simpan</button>
                    <a href="/sertifikasi-latihan3/pertanyaan" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>