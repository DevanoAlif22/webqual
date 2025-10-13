<div class="container py-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold text-primary mb-2"><?= htmlspecialchars($survei['judul']); ?></h3>
                    <p class="text-muted mb-4"><?= nl2br(htmlspecialchars($survei['deskripsi'] ?? '')); ?></p>

                    <form method="POST" action="/sertifikasi-latihan3/survei/kirim" class="needs-validation" novalidate>
                        <input type="hidden" name="id_survei" value="<?= htmlspecialchars($survei['id_survei']); ?>">

                        <h5 class="fw-semibold mb-3">🧍‍♂️ Data Diri Responden</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Umur (20–44) <span class="text-danger">*</span></label>
                                <input type="number" name="umur" min="20" max="44" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jurusan / Asal <span class="text-danger">*</span></label>
                                <input type="text" name="jurusan" class="form-control" placeholder="contoh: Sistem Informasi" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-semibold mb-3">📋 Kuesioner Penilaian WebQual 4.0</h5>
                        <p class="text-muted mb-3">
                            Silakan isi kolom <strong>Harapan</strong> (seberapa penting aspek ini bagi Anda)
                            dan <strong>Penilaian</strong> (seberapa baik website saat ini memenuhi harapan tersebut).<br>
                            Skala: 1 = sangat tidak setuju / tidak penting, 5 = sangat setuju / sangat penting.
                        </p>

                        <?php
                        $dimensiSekarang = null;
                        foreach ($items as $i => $item):
                            if ($dimensiSekarang !== $item['nama_dimensi']):
                                if ($dimensiSekarang !== null) echo "</tbody></table></div>"; // tutup dimensi sebelumnya
                                $dimensiSekarang = $item['nama_dimensi'];
                        ?>
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-primary text-white fw-semibold">
                                        <?= htmlspecialchars($dimensiSekarang); ?>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr class="text-center">
                                                    <th style="width: 60%">Pernyataan</th>
                                                    <th style="width: 20%">Harapan</th>
                                                    <th style="width: 20%">Penilaian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php endif; ?>

                                            <tr>
                                                <td><?= htmlspecialchars($item['teks_pertanyaan']); ?></td>
                                                <td class="text-center">
                                                    <select name="harapan[<?= $item['id_pertanyaan']; ?>]" class="form-select" required>
                                                        <option value="">--</option>
                                                        <?php for ($n = 1; $n <= 5; $n++): ?>
                                                            <option value="<?= $n; ?>"><?= $n; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <select name="jawaban[<?= $item['id_pertanyaan']; ?>]" class="form-select" required>
                                                        <option value="">--</option>
                                                        <?php for ($n = 1; $n <= 5; $n++): ?>
                                                            <option value="<?= $n; ?>"><?= $n; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </td>
                                            </tr>

                                        <?php
                                        $next = $items[$i + 1]['nama_dimensi'] ?? null;
                                        if ($next !== $dimensiSekarang):
                                            echo "</tbody></table></div></div>"; // tutup tabel dimensi terakhir
                                        endif;
                                    endforeach;
                                        ?>

                                        <div class="text-center mt-5">
                                            <button type="submit" class="btn btn-lg btn-success px-5">
                                                <i class="bi bi-send me-1"></i> Kirim Jawaban
                                            </button>
                                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', e => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>