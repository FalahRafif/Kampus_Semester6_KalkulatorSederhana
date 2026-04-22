<?php

function calculator_bootstrap(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (!isset($_SESSION['calc_history']) || !is_array($_SESSION['calc_history'])) {
        $_SESSION['calc_history'] = [];
    }
}

function calculator_get_form_values(array $postData, string $fieldName = 'values'): array
{
    $rawValues = $postData[$fieldName] ?? ['', ''];

    if (!is_array($rawValues)) {
        $rawValues = [$rawValues];
    }

    $cleanValues = [];

    foreach ($rawValues as $item) {
        $cleanValues[] = trim((string) $item);
    }

    if (count($cleanValues) < 2) {
        $cleanValues = array_pad($cleanValues, 2, '');
    }

    return $cleanValues;
}

function calculator_parse_numeric_values(array $formValues): array
{
    $values = [];

    foreach ($formValues as $item) {
        if ($item === '') {
            continue;
        }

        if (!is_numeric($item)) {
            return [
                'values' => [],
                'error' => 'Semua input harus berupa angka yang valid.',
            ];
        }

        $values[] = (float) $item;
    }

    if (count($values) < 2) {
        return [
            'values' => [],
            'error' => 'Masukkan minimal dua angka untuk menghitung.',
        ];
    }

    return [
        'values' => $values,
        'error' => null,
    ];
}

function calculator_calculate(string $operation, array $values): array
{
    if (empty($values)) {
        return [
            'result' => null,
            'error' => 'Nilai perhitungan tidak ditemukan.',
        ];
    }

    switch ($operation) {
        case 'add':
            return [
                'result' => array_sum($values),
                'error' => null,
            ];

        case 'subtract':
            $result = $values[0];

            for ($i = 1; $i < count($values); $i++) {
                $result -= $values[$i];
            }

            return [
                'result' => $result,
                'error' => null,
            ];

        case 'multiply':
            $result = 1.0;

            foreach ($values as $value) {
                $result *= $value;
            }

            return [
                'result' => $result,
                'error' => null,
            ];

        case 'divide':
            $result = $values[0];

            for ($i = 1; $i < count($values); $i++) {
                if ($values[$i] == 0.0) {
                    return [
                        'result' => null,
                        'error' => 'Pembagian dengan nol tidak diperbolehkan.',
                    ];
                }

                $result /= $values[$i];
            }

            return [
                'result' => $result,
                'error' => null,
            ];

        default:
            return [
                'result' => null,
                'error' => 'Operator tidak dikenal.',
            ];
    }
}

function calculator_format_number(float $number): string
{
    if ($number == 0.0) {
        return '0';
    }

    if (floor($number) == $number) {
        return (string) (int) $number;
    }

    $formatted = rtrim(rtrim(sprintf('%.12F', $number), '0'), '.');

    return $formatted === '-0' ? '0' : $formatted;
}

function calculator_build_expression(array $values, string $symbol): string
{
    $formattedValues = array_map(static function ($value): string {
        return calculator_format_number((float) $value);
    }, $values);

    return implode(' ' . $symbol . ' ', $formattedValues);
}

function calculator_add_history(string $operationLabel, string $expression, string $result): void
{
    $entry = [
        'operation' => $operationLabel,
        'expression' => $expression,
        'result' => $result,
        'timestamp' => date('d/m/Y H:i:s'),
    ];

    array_unshift($_SESSION['calc_history'], $entry);
    $_SESSION['calc_history'] = array_slice($_SESSION['calc_history'], 0, 20);
}

function calculator_get_history(): array
{
    return $_SESSION['calc_history'] ?? [];
}

function calculator_clear_history(): void
{
    $_SESSION['calc_history'] = [];
}
