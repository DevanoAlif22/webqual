<div class="container mt-4 mb-5">
    <h4 class="fw-bold mb-3">Hasil WebQual Index</h4>

    <table class="table table-bordered table-sm align-middle">
        <thead class="table-light">
            <tr>
                <th>Indikator</th>
                <th>Maksimum Skor</th>
                <th>Perbandingan Skor</th>
                <th>WebQual Index</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasil as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['kode_pertanyaan']) ?></td>
                    <td><?= number_format($row['maksimum_skor'], 2) ?></td>
                    <td><?= number_format($row['perbandingan'], 2) ?></td>
                    <td><?= number_format($row['wqi'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="table-success fw-bold">
                <td colspan="3" class="text-end">Total</td>
                <td><?= number_format($totalMax, 2) ?></td>
            </tr>
        </tbody>
    </table>

    <h5 class="fw-semibold mt-5 mb-3">Rangkuman per Dimensi</h5>
    <table class="table table-bordered table-sm">
        <thead class="table-light">
            <tr>
                <th>Variabel</th>
                <th>Rata Harapan</th>
                <th>Rata Jawaban</th>
                <th>WQI (%)</th>
                <th>Kualitas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasilDimensi as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['nama_dimensi']) ?></td>
                    <td><?= number_format($d['rata_harapan'], 2) ?></td>
                    <td><?= number_format($d['rata_jawaban'], 2) ?></td>
                    <td><?= number_format($d['wqi'], 2) ?></td>
                    <td><?= htmlspecialchars($d['kategori']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>