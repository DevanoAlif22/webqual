<style>
    .wrap-matrix {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .08);
        overflow: hidden
    }

    .matrix-toolbar {
        display: flex;
        gap: .5rem;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #eef2f7
    }

    .matrix-title {
        font-weight: 700;
        color: #1e293b
    }

    .matrix-controls .form-select {
        min-width: 220px
    }

    .matrix-scroll {
        overflow: auto;
        max-width: 100%
    }

    table.matrix {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 100%;
        font-size: .92rem
    }

    table.matrix th,
    table.matrix td {
        white-space: nowrap;
        padding: .65rem .75rem;
        border-bottom: 1px solid #f1f5f9;
        border-right: 1px solid #f1f5f9;
        vertical-align: middle
    }

    table.matrix thead th {
        background: #f8f9fc;
        color: #475569;
        font-weight: 700
    }

    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 3
    }

    .sticky-left {
        position: sticky;
        left: 0;
        background: #fff;
        z-index: 2
    }

    thead .sticky-left {
        background: #f8f9fc;
        z-index: 4
    }

    .first-col {
        min-width: 260px;
        max-width: 320px
    }

    .dimensi-head {
        background: #eef5ff;
        color: #1e40af;
        text-align: center;
        font-weight: 800;
        border-right: 1px solid #e2e8f0
    }

    .kode-head {
        font-family: "Courier New", monospace;
        font-weight: 700;
        color: #334155;
        text-align: center
    }

    .cell-center {
        text-align: center
    }

    .badge-mail {
        font-size: .8rem;
        color: #64748b
    }

    .legend {
        font-size: .85rem;
        color: #64748b
    }

    @media (max-width:768px) {
        .first-col {
            min-width: 220px
        }
    }
</style>

<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="m-0"><i class="bi bi-table me-1"></i> Matriks Jawaban</h3>
        <div class="legend">1=STS · 2=TS · 3=N · 4=S · 5=SS</div>
    </div>

    <div class="wrap-matrix">
        <div class="matrix-toolbar">
            <div class="matrix-title">Jawaban Responden</div>
            <div class="matrix-controls d-flex align-items-center gap-2">
                <form method="get" action="" class="d-flex gap-2">
                    <select name="tipe" class="form-select form-select-sm" onchange="this.form.submit()">
                        <?php
                        $tipe = $_GET['tipe'] ?? 'penilaian'; // penilaian | harapan
                        $opsi = ['penilaian' => 'Penilaian (Agreement)', 'harapan' => 'Harapan (Importance)'];
                        foreach ($opsi as $k => $v) {
                            echo '<option value="' . $k . '"' . ($tipe === $k ? ' selected' : '') . '>' . $v . '</option>';
                        }
                        ?>
                    </select>
                    <button class="btn btn-sm btn-outline-secondary" formaction="" type="submit">Terapkan</button>
                </form>
            </div>
        </div>

        <div class="matrix-scroll">
            <?php
            // Flatten urutan kolom pertanyaan
            $kolom = []; // [ ['id'=>..,'kode'=>..,'dimensi'=>..], ... ]
            foreach ($dimensis as $d) {
                foreach ($d['pertanyaans'] as $p) {
                    $kolom[] = ['id' => $p['id_pertanyaan'], 'kode' => $p['kode_pertanyaan'], 'dimensi' => $d['nama_dimensi']];
                }
            }
            // Hitung colspan per dimensi
            $colspan = [];
            foreach ($kolom as $c) {
                $colspan[$c['dimensi']] = ($colspan[$c['dimensi']] ?? 0) + 1;
            }
            ?>

            <table class="matrix">
                <thead>
                    <tr>
                        <th class="sticky-top sticky-left first-col">Responden</th>
                        <?php foreach ($colspan as $dim => $cnt): ?>
                            <th class="sticky-top dimensi-head" colspan="<?= (int)$cnt ?>"><?= htmlspecialchars($dim) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th class="sticky-top sticky-left first-col">Nama / Email</th>
                        <?php foreach ($kolom as $c): ?>
                            <th class="sticky-top kode-head"><?= htmlspecialchars($c['kode']) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($responden as $r): ?>
                        <tr>
                            <td class="sticky-left first-col">
                                <div class="fw-semibold"><?= htmlspecialchars($r['nama']) ?></div>
                                <div class="badge-mail"><?= htmlspecialchars($r['email']) ?></div>
                            </td>
                            <?php foreach ($kolom as $c): ?>
                                <?php
                                $val = $nilai[$r['id_responden']][$c['id']] ?? '-';
                                ?>
                                <td class="cell-center"><?= htmlspecialchars($val) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>