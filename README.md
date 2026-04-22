# Kalkulator Sederhana PHP - RPL1

Aplikasi ini berisi beberapa halaman PHP terpisah untuk melakukan operasi aritmatika dasar:

- Penjumlahan (`tambah.php`)
- Pengurangan (`kurang.php`)
- Perkalian (`kali.php`)
- Pembagian (`bagi.php`)

Halaman utama (`index.php`) menyediakan menu untuk memilih operator.

## Cara Menjalankan (Laragon)

1. Pastikan folder proyek ini berada di dalam direktori `www` Laragon (`c:\laragon\www\tugas_RPL1`).
2. Jalankan Laragon dan start Apache (atau Nginx) dan MySQL jika diperlukan.
3. Buka browser dan akses:

   - `http://localhost/tugas_RPL1/index.php`

4. Pilih operator yang diinginkan, masukkan dua angka, lalu tekan tombol **Hitung**.

## Struktur File

- `index.php` &mdash; Menu utama untuk memilih operator.
- `tambah.php` &mdash; Operasi penjumlahan.
- `kurang.php` &mdash; Operasi pengurangan.
- `kali.php` &mdash; Operasi perkalian.
- `bagi.php` &mdash; Operasi pembagian (dengan pengecekan pembagi nol).
- `composer.json` &mdash; File konfigurasi PHP minimal (tidak wajib dijalankan dengan Composer, hanya sebagai metadata proyek).

## Dokumentasi Analisis Kebutuhan

Dokumentasi reverse engineering dan analisis kebutuhan aplikasi tersedia di:

- `DOKUMENTASI_ANALISIS_KEBUTUHAN.md`

