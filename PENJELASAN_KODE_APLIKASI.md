# Penjelasan Kode Aplikasi Kalkulator

Dokumen ini menjelaskan fungsi tiap file dan alur kerja aplikasi secara sederhana.

## 1. Gambaran Besar
Aplikasi ini adalah kalkulator web berbasis PHP dengan 4 operasi:
- Penjumlahan
- Pengurangan
- Perkalian
- Pembagian

Semua halaman operator memakai helper yang sama agar logika tidak diulang-ulang.

## 2. Fungsi Tiap File
### [index.php](index.php)
- Berfungsi sebagai halaman menu utama.
- Menampilkan 4 kartu operator untuk navigasi ke halaman operasi.
- Tidak ada logika hitung di sini, hanya navigasi dan tampilan.

### [tambah.php](tambah.php)
- Menangani operasi penjumlahan multi-input.
- Alur:
  1. Ambil data dari form POST.
  2. Validasi input lewat helper.
  3. Hitung hasil penjumlahan.
  4. Tampilkan hasil atau error.
  5. Simpan ke riwayat session.

### [kurang.php](kurang.php)
- Menangani operasi pengurangan multi-input (berurutan dari kiri ke kanan).
- Pola alur sama seperti tambah, hanya operator perhitungannya berbeda.

### [kali.php](kali.php)
- Menangani operasi perkalian multi-input.
- Pola alur sama seperti tambah dan kurang.

### [bagi.php](bagi.php)
- Menangani operasi pembagian multi-input (berurutan dari kiri ke kanan).
- Memiliki validasi pembagi nol agar tidak terjadi error matematis.

### [includes/calculator_utils.php](includes/calculator_utils.php)
Ini file helper inti backend:
- `calculator_bootstrap()`:
  - Menyalakan session dan menyiapkan wadah riwayat.
- `calculator_get_form_values()`:
  - Mengambil array input `values[]` dari form.
- `calculator_parse_numeric_values()`:
  - Memastikan input berupa angka valid dan minimal 2 nilai.
- `calculator_calculate()`:
  - Menjalankan operasi add/subtract/multiply/divide.
- `calculator_format_number()`:
  - Merapikan format angka output.
- `calculator_build_expression()`:
  - Membuat teks ekspresi hitung untuk ditampilkan.
- `calculator_add_history()`:
  - Menyimpan riwayat ke session (maks 20 data terbaru).
- `calculator_get_history()`:
  - Mengambil riwayat untuk ditampilkan.
- `calculator_clear_history()`:
  - Menghapus seluruh riwayat.

### [assets/js/app.js](assets/js/app.js)
File interaksi frontend:
- Mengatur dark mode (save ke localStorage).
- Membuat tombol toggle dark/light mode.
- Mengatur form multi-input (tambah input, hapus input, sinkron label angka).
- Menambahkan efek visual hover pada kartu operator di halaman utama.

### [assets/css/app.css](assets/css/app.css)
File style utama aplikasi:
- Variabel tema light/dark mode.
- Styling layout utama, card, form, riwayat, tombol, dan animasi.
- Penyesuaian responsif untuk mobile-first.

## 3. Alur Data Sederhana
1. User isi form dan tekan tombol Hitung.
2. Browser kirim data dengan metode POST ke halaman yang sama.
3. PHP validasi data:
   - Harus angka
   - Minimal 2 input
   - Untuk pembagian: tidak boleh membagi dengan nol
4. Jika valid, sistem hitung hasil.
5. Hasil disimpan ke riwayat session.
6. Halaman menampilkan hasil + riwayat terbaru.

## 4. Riwayat Perhitungan
- Riwayat disimpan dalam `$_SESSION['calc_history']`.
- Isinya: jenis operasi, ekspresi, hasil, timestamp.
- Batas maksimum 20 data agar ringan.

## 5. Catatan Penting Untuk Presentasi
- Aplikasi ini tidak memakai database.
- Riwayat bersifat per-session (hilang jika session berakhir).
- Logika backend dipisah ke helper untuk maintainability.
- UI memakai Bootstrap + CSS custom agar konsisten dan responsif.
