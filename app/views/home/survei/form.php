<?php // views/home/survei/form.php 
?>
<div class="container py-5" style="min-height:100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold text-primary mb-1"><?= htmlspecialchars($survei['judul_survei']); ?></h3>
                    <div class="text-muted mb-3">
                        Periode: <?= date('d M Y', strtotime($survei['tanggal_mulai'])) ?> – <?= date('d M Y', strtotime($survei['tanggal_selesai'])) ?>
                    </div>

                    <?php
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    if (!empty($_SESSION['alertError'])) {
                        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['alertError']) . '</div>';
                        unset($_SESSION['alertError']);
                    }
                    if (!empty($_SESSION['alertSuccess'])) {
                        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['alertSuccess']) . '</div>';
                        unset($_SESSION['alertSuccess']);
                    }
                    ?>

                    <form method="POST" action="/webqual/survei/submit" class="needs-validation" novalidate>
                        <input type="hidden" name="id_survei" value="<?= (int)$survei['id_survei'] ?>">

                        <h5 class="fw-semibold mb-3">Data Diri</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama *</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Umur *</label>
                                <input type="number" name="umur" class="form-control" min="10" max="100" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jurusan / Asal *</label>
                                <input type="text" name="jurusan" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pendidikan (opsional)</label>
                                <input type="text" name="pendidikan" class="form-control" placeholder="misal: S1 Sistem Informasi">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pekerjaan (opsional)</label>
                                <input type="text" name="pekerjaan" class="form-control" placeholder="misal: Mahasiswa / ASN / Swasta">
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-semibold mb-2">Kuesioner WebQual 4.0</h5>
                        <p class="text-muted mb-3">
                            Pilih satu jawaban untuk masing-masing pernyataan, baik untuk <b>Harapan</b> maupun <b>Penilaian</b>.<br>
                            Skala: <i>Sangat Tidak Setuju</i> – <i>Tidak Setuju</i> – <i>Netral</i> – <i>Setuju</i> – <i>Sangat Setuju</i>.
                        </p>

                        <?php
                        $curDim = null;
                        $printRadios = function ($name, $required = true) {
                            $labels = [1 => 'Sangat Tidak Setuju', 2 => 'Tidak Setuju', 3 => 'Netral', 4 => 'Setuju', 5 => 'Sangat Setuju'];
                            ob_start();
                            echo '<div class="d-flex flex-wrap gap-4">';
                            foreach ($labels as $n => $text) {
                                $id = $name . '_' . $n . '_' . uniqid();
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="radio" id="' . $id . '" name="' . $name . '" value="' . $n . '" ' . ($required ? 'required' : '') . ' />';
                                echo '<label class="form-check-label" for="' . $id . '">' . $text . '</label>';
                                echo '</div>';
                            }
                            echo '</div>';
                            return ob_get_clean();
                        };
                        ?>

                        <?php foreach ($items as $i => $it): ?>
                            <?php if ($curDim !== $it['nama_dimensi']): ?>
                                <?php if ($curDim !== null): ?>
                </div>
            </div><?php endif; ?>
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                <?= htmlspecialchars($it['nama_dimensi']) ?>
            </div>
            <div class="card-body p-4">
                <?php $curDim = $it['nama_dimensi']; ?>
            <?php endif; ?>

            <div class="mb-4">
                <div class="mb-2 fw-semibold"><?= htmlspecialchars($it['teks_pertanyaan']); ?></div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="small fw-semibold mb-1">Penilaian</div>
                        <?= $printRadios('jawaban[' . $it['id_pertanyaan'] . ']'); ?>
                    </div>
                    <div class="col-12">
                        <div class="small fw-semibold mb-1">Harapan</div>
                        <?= $printRadios('harapan[' . $it['id_pertanyaan'] . ']'); ?>
                    </div>
                </div>
            </div>

            <?php
                            $nextDim = $items[$i + 1]['nama_dimensi'] ?? null;
                            if ($nextDim !== $curDim): ?>
            </div>
        </div><?php endif; ?>
<?php endforeach; ?>

<div class="text-center mt-4">
    <button type="submit" class="btn btn-success btn-lg px-4">Kirim Jawaban</button>
</div>
</form>
        </div>
    </div>

</div>
</div>
</div>

<script>
    (() => {
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(f => {
            f.addEventListener('submit', e => {
                if (!f.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation()
                }
                f.classList.add('was-validated')
            }, false)
        })
    })();
</script>