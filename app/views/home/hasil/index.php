<div class="container mt-4 mb-5">
    <h4 class="fw-bold mb-3">Hasil WebQual Index</h4>

    <!-- Per-Butir (Indikator) -->
    <table class="table table-bordered table-sm align-middle">
        <thead class="table-light">
            <tr class="text-center">
                <th style="width:12%">Indikator</th>
                <th style="width:12%">Mean Importance</th>
                <th style="width:12%">Mean Agreement</th>
                <th style="width:14%">Maximum Score (MS)</th>
                <th style="width:14%">Weighted Score (WS)</th>
                <th style="width:12%">WQI (0–1)</th>
                <th style="width:12%">WQI (%)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($hasil ?? []) as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['kode_pertanyaan'] ?? '-') ?></td>
                    <td class="text-end"><?= number_format($row['mean_importance'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($row['mean_agreement'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($row['maximum_score'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($row['weighted_score'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($row['wqi_item'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($row['wqi_percent'] ?? 0, 2) ?></td>
                </tr>
            <?php endforeach; ?>

            <?php if (!empty($total)): ?>
                <tr class="table-success fw-bold">
                    <td class="text-end">Total</td>
                    <td></td>
                    <td></td>
                    <td class="text-end"><?= number_format($total['total_maximum_score'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($total['total_weighted_score'] ?? 0, 3) ?></td>
                    <td class="text-end">—</td>
                    <td class="text-end">
                        <?= number_format($total['wqi_overall'] ?? 0, 2) ?>%
                        <?php if (!empty($total['kategori_overall'])): ?>
                            <span class="badge bg-success ms-2"><?= htmlspecialchars($total['kategori_overall']) ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Rangkuman per Dimensi -->
    <h5 class="fw-semibold mt-5 mb-3">Rangkuman per Dimensi</h5>
    <table class="table table-bordered table-sm align-middle">
        <thead class="table-light">
            <tr class="text-center">
                <th>Variabel</th>
                <th>Rata Harapan</th>
                <th>Rata Jawaban</th>
                <th>Σ Maximum Score</th>
                <th>Σ Weighted Score</th>
                <th>WQI (%)</th>
                <th>Kualitas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($hasilDimensi ?? []) as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['nama_dimensi'] ?? '-') ?></td>
                    <td class="text-end"><?= number_format($d['rata_harapan'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($d['rata_jawaban'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($d['maximum_score_sum'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($d['weighted_score_sum'] ?? 0, 3) ?></td>
                    <td class="text-end"><?= number_format($d['wqi'] ?? 0, 2) ?>%</td>
                    <td>
                        <?php if (!empty($d['kategori'])): ?>
                            <span class="badge bg-primary"><?= htmlspecialchars($d['kategori']) ?></span>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>