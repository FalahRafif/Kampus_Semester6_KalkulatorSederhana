<?php
// Halaman utama: menu operator matematika sederhana

/*
ALUR BELAJAR (mulai dari sini):
1) File ini hanya menu navigasi operator.
2) Setelah paham tampilan menu, lanjut ke salah satu file operator:
    - tambah.php / kurang.php / kali.php / bagi.php
3) Saat di file operator, ikuti komentar "ALUR BELAJAR" berikutnya.
*/
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Sederhana PHP</title>
    <!-- Memuat font, Bootstrap, dan stylesheet custom aplikasi -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="app-shell">
    <main class="container py-4 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <section class="glass-panel p-4 p-md-5 fade-up">
                    <!-- Header aplikasi dan deskripsi singkat -->
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                        <div>
                            <span class="brand-chip mb-2">RPL1 • PHP Project</span>
                            <h1 class="h2 fw-bold mb-2">Kalkulator Sederhana</h1>
                            <p class="text-secondary mb-0">Pilih operator untuk mulai menghitung dua bilangan dengan cepat.</p>
                        </div>
                        <div class="text-md-end">
                            <p class="mb-0 small text-secondary">Desain modern, tetap dengan alur bisnis yang sama.</p>
                        </div>
                    </div>

                    <!-- Kartu menu untuk masuk ke masing-masing halaman operasi -->
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <a href="tambah.php" class="operation-card text-decoration-none d-block h-100">
                                <span class="operation-icon icon-plus">+</span>
                                <h2 class="h6 fw-bold mb-1">Penjumlahan</h2>
                                <p class="small text-secondary mb-0">Hitung total dari dua angka.</p>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="kurang.php" class="operation-card text-decoration-none d-block h-100">
                                <span class="operation-icon icon-minus">-</span>
                                <h2 class="h6 fw-bold mb-1">Pengurangan</h2>
                                <p class="small text-secondary mb-0">Cari selisih angka pertama dan kedua.</p>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="kali.php" class="operation-card text-decoration-none d-block h-100">
                                <span class="operation-icon icon-kali">×</span>
                                <h2 class="h6 fw-bold mb-1">Perkalian</h2>
                                <p class="small text-secondary mb-0">Kalikan dua nilai numerik.</p>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="bagi.php" class="operation-card text-decoration-none d-block h-100">
                                <span class="operation-icon icon-bagi">/</span>
                                <h2 class="h6 fw-bold mb-1">Pembagian</h2>
                                <p class="small text-secondary mb-0">Bagi angka pertama dengan angka kedua.</p>
                            </a>
                        </div>
                    </div>

                    <p class="text-center text-secondary small mb-0 mt-4">RPL1 • Operator Matematika Sederhana</p>
                </section>
            </div>
        </div>
    </main>
    <!-- Bootstrap JS + script interaksi global (dark mode, multi input, efek hover) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>

