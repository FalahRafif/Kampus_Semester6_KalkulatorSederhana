<?php
require_once __DIR__ . '/includes/calculator_utils.php';

calculator_bootstrap();

$hasil = null;
$hasilTeks = null;
$expression = null;
$error = null;
$inputValues = ['', ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'calculate';

    if ($action === 'clear_history') {
        calculator_clear_history();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    $inputValues = calculator_get_form_values($_POST);
    $parsed = calculator_parse_numeric_values($inputValues);
    $values = $parsed['values'];
    $error = $parsed['error'];

    if ($error === null) {
        $calculated = calculator_calculate('subtract', $values);
        $error = $calculated['error'];

        if ($error === null) {
            $hasil = (float) $calculated['result'];
            $hasilTeks = calculator_format_number($hasil);
            $expression = calculator_build_expression($values, '-');
            calculator_add_history('Pengurangan', $expression, $hasilTeks);
        }
    }
}

$history = calculator_get_history();
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
                    <p class="text-secondary small mb-0">Masukkan minimal dua angka. Operasi diproses berurutan dari kiri ke kanan.</p>

                    <form method="post" class="mt-4 calc-form" data-multi-input-form data-min-input="2">
                        <input type="hidden" name="action" value="calculate">

                        <div class="vstack gap-2 mb-3" data-values-container>
                            <?php foreach ($inputValues as $index => $value): ?>
                                <div class="input-group multi-input-row">
                                    <span class="input-group-text">Angka <?php echo $index + 1; ?></span>
                                    <input type="number" step="any" name="values[]" class="form-control calc-value-input" placeholder="Masukkan angka" value="<?php echo htmlspecialchars($value); ?>" <?php echo $index < 2 ? 'required' : ''; ?>>
                                    <button type="button" class="btn btn-outline-danger remove-input-btn" <?php echo $index < 2 ? 'disabled' : ''; ?>>Hapus</button>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-add-input>Tambah Input</button>
                        </div>

                        <button type="submit" class="btn btn-accent w-100 py-2">Hitung</button>
                    </form>

                    <?php if ($error): ?>
                        <div class="alert alert-danger mt-4 mb-0" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php elseif ($hasil !== null): ?>
                        <div class="result-box p-3 mt-4">
                            <?php echo htmlspecialchars($expression) . " = <strong>" . htmlspecialchars($hasilTeks) . "</strong>"; ?>
                        </div>
                    <?php endif; ?>

                    <div class="history-box mt-4 p-3">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                            <h2 class="h6 mb-0">Riwayat Perhitungan</h2>
                            <?php if (!empty($history)): ?>
                                <form method="post" class="m-0">
                                    <input type="hidden" name="action" value="clear_history">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Hapus Riwayat</button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <?php if (empty($history)): ?>
                            <p class="small text-secondary mb-0">Belum ada riwayat perhitungan.</p>
                        <?php else: ?>
                            <ul class="list-unstyled history-list mb-0">
                                <?php foreach ($history as $item): ?>
                                    <li class="history-item">
                                        <div class="d-flex justify-content-between gap-2 flex-wrap">
                                            <strong><?php echo htmlspecialchars($item['operation']); ?></strong>
                                            <span class="small text-secondary"><?php echo htmlspecialchars($item['timestamp']); ?></span>
                                        </div>
                                        <p class="mb-0 small"><?php echo htmlspecialchars($item['expression']); ?> = <strong><?php echo htmlspecialchars($item['result']); ?></strong></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <a href="index.php" class="btn btn-outline-secondary w-100 mt-3">Kembali ke menu utama</a>
                </section>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>

