<style>
    .page-header {
        margin-bottom: 1.5rem;
    }

    .page-header h2 {
        margin: 0;
        font-weight: 600;
        font-size: 1.5rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .page-header h2 i {
        color: #64748b;
        font-size: 1.4rem;
    }

    .card-modern {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .card-modern .card-header {
        background: linear-gradient(90deg, #4c6ef5, #5f3dc4);
        color: white;
        padding: 1rem 1.5rem;
        border: none;
    }

    .card-modern .card-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-modern .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.7rem 1rem;
        border: 1px solid #e2e8f0;
        box-shadow: none;
        transition: all 0.2s;
    }

    .form-control:focus {
        border-color: #4c6ef5;
        box-shadow: 0 0 0 0.15rem rgba(76, 110, 245, 0.25);
    }

    .btn-gradient {
        background: linear-gradient(90deg, #4c6ef5, #5f3dc4);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        transition: all 0.3s;
        box-shadow: 0 2px 6px rgba(76, 110, 245, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-gradient:hover {
        background: linear-gradient(90deg, #5f3dc4, #4c6ef5);
        box-shadow: 0 4px 12px rgba(76, 110, 245, 0.4);
        color: #fff;
    }

    .btn-outline-secondary {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        color: #475569;
        padding: 0.6rem 1.2rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-outline-secondary:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    @media (max-width: 768px) {
        .card-modern .card-body {
            padding: 1.25rem;
        }

        .page-header h2 {
            font-size: 1.3rem;
        }
    }
</style>

<div class="page-content">
    <div class="page-header">
        <h2><i class="bi bi-pencil-square"></i> Edit Dimensi</h2>
        <p>Perbarui informasi dimensi penilaian WebQual</p>
    </div>

    <div class="card-modern">
        <div class="card-header">
            <h5><i class="bi bi-diagram-project"></i> Form Edit Dimensi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/webqual/admin/dimensi/update">
                <input type="hidden" name="id_dimensi" value="<?= (int)$dimensi['id_dimensi']; ?>">

                <div class="mb-3">
                    <label class="form-label">Kode Dimensi *</label>
                    <input type="text" name="kode_dimensi" class="form-control"
                        value="<?= htmlspecialchars($dimensi['kode_dimensi']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Dimensi *</label>
                    <input type="text" name="nama_dimensi" class="form-control"
                        value="<?= htmlspecialchars($dimensi['nama_dimensi']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi (opsional)</label>
                    <textarea name="deskripsi" class="form-control" rows="4"
                        placeholder="Tuliskan deskripsi atau penjelasan dimensi ini..."><?= htmlspecialchars($dimensi['keterangan'] ?? ''); ?></textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-gradient">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="/webqual/admin/dimensi" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>