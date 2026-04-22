<?php
// Halaman utama: menu operator matematika sederhana
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Sederhana PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 24px 32px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            margin-top: 0;
            text-align: center;
        }
        .opsi {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }
        a.btn {
            display: inline-block;
            text-align: center;
            padding: 10px 0;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            color: #ffffff;
        }
        .plus { background: #22c55e; }
        .minus { background: #ef4444; }
        .kali { background: #3b82f6; }
        .bagi { background: #a855f7; }
        .footer {
            margin-top: 16px;
            font-size: 12px;
            text-align: center;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kalkulator Sederhana</h1>
        <p>Pilih operator yang ingin digunakan:</p>
        <div class="opsi">
            <a href="tambah.php" class="btn plus">Penjumlahan (+)</a>
            <a href="kurang.php" class="btn minus">Pengurangan (-)</a>
            <a href="kali.php" class="btn kali">Perkalian (×)</a>
            <a href="bagi.php" class="btn bagi">Pembagian (/)</a>
        </div>
        <div class="footer">
            <p>RPL1 &mdash; Operator Matematika Sederhana</p>
        </div>
    </div>
</body>
</html>

