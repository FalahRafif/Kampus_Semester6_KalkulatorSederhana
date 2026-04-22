<?php
$hasil = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = isset($_POST['a']) ? (float) $_POST['a'] : 0;
    $b = isset($_POST['b']) ? (float) $_POST['b'] : 0;

    if ($b == 0) {
        $error = 'Pembagian dengan nol tidak diperbolehkan.';
    } else {
        $hasil = $a / $b;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembagian (/)</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; display:flex; justify-content:center; align-items:center; min-height:100vh; }
        .card { background:#fff; padding:24px 32px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.08); max-width:420px; width:100%; }
        h1 { margin-top:0; text-align:center; color:#a855f7; }
        form { display:flex; flex-direction:column; gap:10px; margin-top:12px; }
        label { font-weight:600; }
        input[type="number"] { padding:8px; border-radius:4px; border:1px solid #d1d5db; }
        button { margin-top:4px; padding:10px; border:none; border-radius:6px; background:#a855f7; color:#fff; font-weight:600; cursor:pointer; }
        button:hover { background:#7e22ce; }
        .result { margin-top:12px; padding:10px; border-radius:6px; background:#f5f3ff; border:1px solid #ddd6fe; }
        .error { margin-top:12px; padding:10px; border-radius:6px; background:#fef2f2; border:1px solid #fecaca; color:#b91c1c; }
        .back { margin-top:8px; text-align:center; }
        .back a { text-decoration:none; color:#3b82f6; font-size:14px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Pembagian (/)</h1>
        <form method="post">
            <label for="a">Angka pertama</label>
            <input type="number" step="any" name="a" id="a" required value="<?php echo isset($_POST['a']) ? htmlspecialchars($_POST['a']) : ''; ?>">

            <label for="b">Angka kedua</label>
            <input type="number" step="any" name="b" id="b" required value="<?php echo isset($_POST['b']) ? htmlspecialchars($_POST['b']) : ''; ?>">

            <button type="submit">Hitung</button>
        </form>

        <?php if ($error): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php elseif ($hasil !== null): ?>
            <div class="result">
                <?php echo htmlspecialchars($_POST['a']) . " / " . htmlspecialchars($_POST['b']) . " = <strong>" . $hasil . "</strong>"; ?>
            </div>
        <?php endif; ?>

        <div class="back">
            <a href="index.php">← Kembali ke menu utama</a>
        </div>
    </div>
</body>
</html>

