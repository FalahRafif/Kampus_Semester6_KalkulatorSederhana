# Dokumentasi Analisis Kebutuhan Aplikasi

## 1. Informasi Umum
- Nama aplikasi: Kalkulator Sederhana PHP
- Domain: Utility perhitungan aritmatika dasar
- Platform: Web (browser)
- Bahasa pemrograman: PHP + HTML + CSS inline
- Arsitektur: Multi-page procedural PHP (tanpa framework)

## 2. Latar Belakang dan Tujuan
Aplikasi ini dibuat untuk membantu pengguna melakukan operasi matematika dasar dengan antarmuka web yang sederhana.

Tujuan utama:
- Menyediakan perhitungan cepat untuk operasi tambah, kurang, kali, dan bagi.
- Menunjukkan implementasi dasar request-response HTTP metode POST di PHP.
- Menangani kondisi khusus pembagian dengan nol secara aman di sisi aplikasi.

## 3. Hasil Reverse Engineering Singkat
Berdasarkan pembacaan kode sumber:
- Halaman [index.php](index.php) berfungsi sebagai menu navigasi ke 4 operasi.
- Setiap operasi diimplementasikan pada file terpisah:
  - [tambah.php](tambah.php)
  - [kurang.php](kurang.php)
  - [kali.php](kali.php)
  - [bagi.php](bagi.php)
- Input menggunakan elemen form dengan method POST dan dua field angka (a, b).
- Perhitungan dilakukan di sisi server menggunakan casting ke float.
- Output hasil ditampilkan kembali pada halaman yang sama.
- Khusus pembagian terdapat validasi pembagi 0 dan menampilkan pesan error.

## 4. Ruang Lingkup Sistem
Termasuk dalam ruang lingkup:
- Pemilihan operasi aritmatika.
- Input dua bilangan numerik.
- Eksekusi perhitungan dan menampilkan hasil.
- Menampilkan pesan kesalahan saat pembagian dengan nol.

Tidak termasuk dalam ruang lingkup saat ini:
- Penyimpanan histori perhitungan.
- Login pengguna.
- API eksternal.
- Persistensi database.
- Multi-operasi dalam satu halaman.

## 5. Identifikasi Pemangku Kepentingan
- Pengguna akhir: Mahasiswa atau pengguna umum yang ingin menghitung cepat.
- Pengembang: Mahasiswa/pembuat tugas untuk demonstrasi konsep dasar web PHP.
- Dosen/asisten: Penilai fungsionalitas dan kualitas implementasi tugas.

## 6. Aktor Sistem
- Aktor utama: Pengguna

## 7. Kebutuhan Fungsional
### FR-01 Navigasi Menu Utama
Sistem harus menampilkan menu utama berisi 4 pilihan operasi (tambah, kurang, kali, bagi).

Kriteria penerimaan:
- Pengguna melihat 4 tombol/link operasi pada halaman utama.
- Masing-masing tombol mengarah ke halaman operasi yang sesuai.

### FR-02 Input Dua Bilangan
Sistem harus menerima dua bilangan dari pengguna untuk setiap operasi.

Kriteria penerimaan:
- Tersedia 2 field input numerik.
- Kedua field wajib diisi sebelum form dikirim.

### FR-03 Proses Penjumlahan
Sistem harus menghitung hasil a + b saat pengguna submit form penjumlahan.

Kriteria penerimaan:
- Hasil perhitungan ditampilkan setelah submit.
- Ekspresi operasi ditampilkan bersama hasil.

### FR-04 Proses Pengurangan
Sistem harus menghitung hasil a - b saat pengguna submit form pengurangan.

Kriteria penerimaan:
- Hasil perhitungan ditampilkan setelah submit.
- Ekspresi operasi ditampilkan bersama hasil.

### FR-05 Proses Perkalian
Sistem harus menghitung hasil a x b saat pengguna submit form perkalian.

Kriteria penerimaan:
- Hasil perhitungan ditampilkan setelah submit.
- Ekspresi operasi ditampilkan bersama hasil.

### FR-06 Proses Pembagian
Sistem harus menghitung hasil a / b saat pengguna submit form pembagian jika b tidak sama dengan nol.

Kriteria penerimaan:
- Jika b != 0, hasil perhitungan ditampilkan.
- Ekspresi operasi ditampilkan bersama hasil.

### FR-07 Validasi Pembagian Nol
Sistem harus menolak operasi pembagian ketika b = 0 dan menampilkan pesan error.

Kriteria penerimaan:
- Tidak ada hasil pembagian yang ditampilkan jika b = 0.
- Pesan error jelas tampil ke pengguna.

### FR-08 Navigasi Kembali
Sistem harus menyediakan link kembali ke menu utama dari setiap halaman operasi.

Kriteria penerimaan:
- Link kembali tersedia di seluruh halaman operasi.
- Klik link mengarahkan pengguna ke halaman menu utama.

## 8. Kebutuhan Non-Fungsional
### NFR-01 Usability
- Antarmuka sederhana dan mudah dipahami untuk pengguna pemula.
- Konsistensi tata letak form di semua halaman operasi.

### NFR-02 Performance
- Waktu respon halaman perhitungan ditargetkan kurang dari 1 detik pada localhost.

### NFR-03 Compatibility
- Dapat berjalan pada PHP versi 7.4 ke atas (sesuai [composer.json](composer.json)).
- Dapat diakses dari browser modern (Chrome, Edge, Firefox).

### NFR-04 Security Dasar
- Input numerik dibatasi melalui field type number.
- Output input pengguna di-escape dengan htmlspecialchars sebelum dirender.

### NFR-05 Maintainability
- Pemisahan file per operasi memudahkan modifikasi fitur per halaman.
- Struktur file sederhana untuk pembelajaran dasar.

## 9. Use Case Utama
### UC-01 Menghitung Operasi Aritmatika
- Aktor: Pengguna
- Tujuan: Mendapatkan hasil perhitungan dari dua bilangan
- Prasyarat: Halaman web dapat diakses

Alur utama:
1. Pengguna membuka menu utama.
2. Pengguna memilih salah satu operasi.
3. Sistem menampilkan form input dua bilangan.
4. Pengguna mengisi nilai bilangan pertama dan kedua.
5. Pengguna menekan tombol Hitung.
6. Sistem memproses perhitungan sesuai operasi.
7. Sistem menampilkan hasil perhitungan.

Alur alternatif (pembagian nol):
1. Pengguna memilih operasi pembagian.
2. Pengguna mengisi bilangan kedua dengan 0.
3. Pengguna menekan tombol Hitung.
4. Sistem menampilkan pesan error pembagian dengan nol tidak diperbolehkan.

Post-condition:
- Hasil atau pesan error tampil pada halaman operasi.

## 10. Aturan Bisnis
- BR-01: Semua operasi menggunakan dua operand (a dan b).
- BR-02: Operasi hanya diproses setelah form POST diterima.
- BR-03: Pembagian hanya valid jika pembagi tidak sama dengan 0.
- BR-04: Nilai operand diproses sebagai float.

## 11. Asumsi dan Batasan
Asumsi:
- Pengguna memasukkan input angka valid melalui browser.
- Aplikasi digunakan dalam konteks pembelajaran lokal (localhost/Laragon).

Batasan:
- Tidak ada penyimpanan histori atau audit perhitungan.
- Tidak ada manajemen sesi atau autentikasi pengguna.
- Belum ada pengujian otomatis (unit/integration test).

## 12. Matriks Keterlacakan (Traceability)
- FR-01: Tercermin pada menu pilihan operasi di [index.php](index.php).
- FR-02: Tercermin pada form input angka di [tambah.php](tambah.php), [kurang.php](kurang.php), [kali.php](kali.php), [bagi.php](bagi.php).
- FR-03: Logika penjumlahan di [tambah.php](tambah.php).
- FR-04: Logika pengurangan di [kurang.php](kurang.php).
- FR-05: Logika perkalian di [kali.php](kali.php).
- FR-06 dan FR-07: Logika pembagian dan validasi nol di [bagi.php](bagi.php).
- FR-08: Link kembali ke menu pada semua file operasi.

## 13. Rekomendasi Pengembangan Lanjutan
- Menyatukan seluruh operasi dalam satu halaman dinamis agar mengurangi duplikasi kode.
- Menambahkan validasi server-side yang lebih ketat (misalnya filter_input).
- Menambahkan histori perhitungan (session atau database).
- Menambahkan pengujian otomatis sederhana untuk logika aritmatika.
- Menambahkan pemisahan layer presentasi dan logika (misalnya MVC sederhana).

## 14. Kesimpulan
Aplikasi telah memenuhi kebutuhan inti kalkulator aritmatika dasar berbasis web dengan alur yang jelas dan implementasi sederhana. Hasil reverse engineering menunjukkan fitur utama berjalan sesuai tujuan pembelajaran, dengan validasi penting pada kasus pembagian nol. Dokumen ini dapat digunakan sebagai analisis kebutuhan awal untuk laporan tugas kuliah RPL.
