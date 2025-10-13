<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-plus"></i> Tambah Dimensi</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color: black;"><i class="fas fa-diagram-project"></i> Form Tambah Dimensi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/sertifikasi-latihan3/dimensi/store">
                <div class="mb-3">
                    <label class="form-label">Kode Dimensi *</label>
                    <input type="text" name="kode_dimensi" class="form-control" placeholder="contoh: USABILITY" required>
                    <small class="text-muted">Gunakan huruf besar & unik (misal: USABILITY, INFO_QUALITY, SERVICE_INTERACTION).</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Dimensi *</label>
                    <input type="text" name="nama_dimensi" class="form-control" placeholder="contoh: Kegunaan (Usability)" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan fokus penilaian dimensi ini..."></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient"><i class="fas fa-save"></i> Simpan</button>
                    <a href="/sertifikasi-latihan3/dimensi" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>