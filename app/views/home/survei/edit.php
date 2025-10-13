<?php
// helper: ubah "YYYY-mm-dd HH:ii:ss" ke "YYYY-mm-ddTHH:ii"
$fmt = function ($dt) {
    if (!$dt) return '';
    $t = strtotime($dt);
    return $t ? date('Y-m-d\TH:i', $t) : '';
};
?>
<div class="page-content">
    <div class="row mb-3">
        <div class="col">
            <h3><i class="fas fa-edit"></i> Edit Survei</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient text-white">
            <h5 style="color:black;"><i class="fas fa-calendar-check"></i> Form Edit Survei</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/sertifikasi-latihan3/survei/update">
                <input type="hidden" name="id_survei" value="<?= (int)$survei['id_survei']; ?>">

                <div class="mb-3">
                    <label class="form-label">Judul Survei *</label>
                    <input type="text" name="judul_survei" class="form-control" value="<?= htmlspecialchars($survei['judul_survei']); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai *</label>
                        <input type="datetime-local" name="tanggal_mulai" class="form-control"
                            value="<?= htmlspecialchars($fmt($survei['tanggal_mulai'])); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai *</label>
                        <input type="datetime-local" name="tanggal_selesai" class="form-control"
                            value="<?= htmlspecialchars($fmt($survei['tanggal_selesai'])); ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-control" required>
                        <?php
                        $opts = ['draf' => 'Draf', 'berjalan' => 'Berjalan', 'selesai' => 'Selesai'];
                        foreach ($opts as $val => $label):
                        ?>
                            <option value="<?= $val ?>" <?= $survei['status'] === $val ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- opsional: deskripsi -->
                <!--
                    <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($survei['deskripsi'] ?? '') ?></textarea>
                    </div>
                -->

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gradient"><i class="fas fa-save"></i> Update</button>
                    <a href="/sertifikasi-latihan3/survei" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>