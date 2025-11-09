<?php
// views/home/survei/closed.php

// Boleh tampilkan flash message kalau ada
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<div class="container py-5" style="min-height:100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <?php if (!empty($_SESSION['alertError'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['alertError']); ?>
                </div>
                <?php unset($_SESSION['alertError']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['alertSuccess'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['alertSuccess']); ?>
                </div>
                <?php unset($_SESSION['alertSuccess']); ?>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-5 text-center">
                    <div class="mb-3">
                        <!-- ikon sederhana -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-clipboard-x text-secondary" viewBox="0 0 16 16" aria-hidden="true">
                            <path d="M6.5 0A1.5 1.5 0 0 0 5 .5H4a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5a2 2 0 0 0-2-2h-1a1.5 1.5 0 0 0-1.5-1h-3ZM9 1.5a.5.5 0 0 1-.5.5h-1A.5.5 0 0 1 7 1.5h2Z" />
                            <path d="M8.146 8.146a.5.5 0 1 1 .708.708L8.707 9l.147.146a.5.5 0 0 1-.708.708L8 9.707l-.146.147a.5.5 0 0 1-.708-.708L7.293 9l-.147-.146a.5.5 0 0 1 .708-.708L8 8.293l.146-.147Z" />
                        </svg>
                    </div>

                    <h3 class="fw-bold mb-2">Survei Ditutup</h3>
                    <p class="text-muted mb-4">
                        Saat ini <strong>tidak ada survei yang sedang berjalan</strong>.
                        Silakan cek kembali di lain waktu.
                    </p>

                    <?php
                    // Jika controller suatu saat mengirim info survei berikutnya, tampilkan:
                    // mis. $nextSurvei = ['judul_survei' => 'WebQual Periode Desember', 'tanggal_mulai' => '2025-12-10'];
                    if (!empty($nextSurvei) && !empty($nextSurvei['tanggal_mulai'])):
                    ?>
                        <div class="alert alert-info text-start mx-auto" style="max-width:560px;">
                            <div class="fw-semibold">Info Survei Berikutnya</div>
                            <div class="small mb-0">
                                <?php if (!empty($nextSurvei['judul_survei'])): ?>
                                    Judul: <?= htmlspecialchars($nextSurvei['judul_survei']); ?><br>
                                <?php endif; ?>
                                Mulai: <?= date('d M Y', strtotime($nextSurvei['tanggal_mulai'])); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <p class="text-center text-muted small mt-3 mb-0">
                Butuh bantuan? Hubungi admin.
            </p>
        </div>
    </div>
</div>