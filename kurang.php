<?php
$hasil = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = isset($_POST['a']) ? (float) $_POST['a'] : 0;
    $b = isset($_POST['b']) ? (float) $_POST['b'] : 0;
    $hasil = $a - $b;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengurangan (-)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="app-shell operation-theme-minus">
    <main class="container py-4 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <section class="glass-panel p-4 p-md-5 fade-up">
                    <span class="brand-chip mb-2">Operator Matematika</span>
                    <h1 class="h3 fw-bold calc-title">Pengurangan (-)</h1>
                    <p class="text-secondary small mb-0">Masukkan dua angka untuk menghitung selisih.</p>

                    <form method="post" class="mt-4">
                        <div class="form-floating mb-3">
                            <input type="number" step="any" name="a" id="a" required class="form-control" placeholder="Angka pertama" value="<?php echo isset($_POST['a']) ? htmlspecialchars($_POST['a']) : ''; ?>">
                            <label for="a">Angka pertama</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" step="any" name="b" id="b" required class="form-control" placeholder="Angka kedua" value="<?php echo isset($_POST['b']) ? htmlspecialchars($_POST['b']) : ''; ?>">
                            <label for="b">Angka kedua</label>
                        </div>

                        <button type="submit" class="btn btn-accent w-100 py-2">Hitung</button>
                    </form>

                    <?php if ($hasil !== null): ?>
                        <div class="result-box p-3 mt-4">
                            <?php echo htmlspecialchars($_POST['a']) . " - " . htmlspecialchars($_POST['b']) . " = <strong>" . $hasil . "</strong>"; ?>
                        </div>
                    <?php endif; ?>

                    <a href="index.php" class="btn btn-outline-secondary w-100 mt-3">Kembali ke menu utama</a>
                </section>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>

