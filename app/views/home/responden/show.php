<?php
// Safety defaults biar ga notice kalau belum di-set
$responden = $responden ?? [];
$ringkasan = $ringkasan ?? [];
$id_survei = $id_survei ?? 0;

// helper format tanggal aman
function fmt_tgl($v)
{
    if (empty($v)) return '-';
    $ts = strtotime($v);
    return $ts ? date('d M Y H:i', $ts) : '-';
}
?>
<style>
    .wrap-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .08);
        overflow: hidden
    }

    .section-title {
        font-weight: 800;
        color: #0f172a
    }
</style>

<div class="page-content">

    <!-- Header identitas responden -->
    <div class="wrap-card mb-4">
        <div class="p-3 border-bottom bg-light">
            <h3 class="m-0"><i class="bi bi-person-badge me-2"></i> Detail Responden</h3>
        </div>
        <div class="p-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Nama</div>
                    <div class="fs-6"><?= htmlspecialchars($responden['nama'] ?? '-') ?></div>
                </div>
                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Email</div>
                    <div class="fs-6"><?= htmlspecialchars($responden['email'] ?? '-') ?></div>
                </div>
                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Jenis Kelamin</div>
                    <div class="fs-6"><?= htmlspecialchars($responden['jenis_kelamin'] ?? '-') ?></div>
                </div>

                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Umur</div>
                    <div class="fs-6"><?= isset($responden['umur']) ? (int)$responden['umur'] : '-' ?></div>
                </div>

                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Jurusan/Asal</div>
                    <div class="fs-6"><?= htmlspecialchars($responden['jurusan'] ?? '-') ?></div>
                </div>
                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Survei</div>
                    <div class="fs-6">
                        <?= $id_survei ? 'ID #' . (int)$id_survei : '<span class="text-muted">Belum dipilih</span>' ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Dibuat pada</div>
                    <div class="fs-6"><?= fmt_tgl($responden['dibuat_pada'] ?? null) ?></div>
                </div>
                <div class="col-md-4">
                    <div class="fw-semibold text-muted">Diperbarui pada</div>
                    <div class="fs-6"><?= fmt_tgl($responden['diperbarui_pada'] ?? null) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan jawaban responden -->
    <h4 class="mt-4 mb-2 section-title">Ringkasan Jawaban</h4>
    <div class="wrap-card">
        <div class="p-0">
            <table class="table table-bordered table-sm m-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:16%">Dimensi</th>
                        <th>Pertanyaan</th>
                        <th class="text-center" style="width:10%">Harapan</th>
                        <th class="text-center" style="width:10%">Penilaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ringkasan)): ?>
                        <?php foreach ($ringkasan as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nama_dimensi'] ?? '-') ?></td>
                                <td>
                                    <div class="fw-semibold">
                                        <?= htmlspecialchars($row['kode_pertanyaan'] ?? '-') ?>
                                    </div>
                                    <div class="text-muted small">
                                        <?= htmlspecialchars($row['teks_pertanyaan'] ?? '-') ?>
                                    </div>
                                </td>
                                <td class="text-center"><?= htmlspecialchars((string)($row['harapan'] ?? '-')) ?></td>
                                <td class="text-center"><?= htmlspecialchars((string)($row['jawaban'] ?? '-')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada jawaban untuk responden ini pada survei yang dipilih.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>