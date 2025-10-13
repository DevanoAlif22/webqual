<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-plus"></i> Tambah Survei</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color:black;"><i class="fas fa-calendar-plus"></i> Form Tambah Survei</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/sertifikasi-latihan3/survei/store">
                <div class="mb-3">
                    <label class="form-label">Judul Survei *</label>
                    <input type="text" name="judul_survei" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai *</label>
                        <input type="datetime-local" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai *</label>
                        <input type="datetime-local" name="tanggal_selesai" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="draf">Draf</option>
                        <option value="berjalan">Berjalan</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <small class="text-muted">Status <b>“berjalan”</b> akan aktif jika tanggal sekarang berada di rentang mulai–selesai.</small>
                </div>

                <!-- opsional: deskripsi -->
                <!--
                    <div class="mb-3">
                    <label class="form-label">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                -->

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient"><i class="fas fa-save"></i> Simpan</button>
                    <a href="/sertifikasi-latihan3/survei" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>