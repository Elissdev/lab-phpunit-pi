<?php

require_once 'vendor/autoload.php';

$validador = new ValidadorNotaFiscal();

echo "=== Exemplos de cálculo de imposto retido ===\n";

// Exemplo 1: MEI
try {
    $imposto = $validador->calcularImpostoRetido(1500.0, 'MEI');
    echo "MEI, valor 1500.00 -> imposto: " . number_format($imposto, 2) . "\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

// Exemplo 2: LTDA
try {
    $imposto = $validador->calcularImpostoRetido(1500.0, 'LTDA');
    echo "LTDA, valor 1500.00 -> imposto: " . number_format($imposto, 2) . "\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

// Exemplo 3: Valor zero (deve lançar exceção)
try {
    $imposto = $validador->calcularImpostoRetido(0.0, 'MEI');
    echo "MEI, valor 0.00 -> imposto: " . number_format($imposto, 2) . "\n";
} catch (Exception $e) {
    echo "Erro ao calcular imposto com valor zero: " . $e->getMessage() . "\n";
}

// Exemplo 4: Tipo inválido
try {
    $imposto = $validador->calcularImpostoRetido(1000.0, 'SA');
    echo "SA, valor 1000.00 -> imposto: " . number_format($imposto, 2) . "\n";
} catch (Exception $e) {
    echo "Erro ao calcular imposto com tipo inválido: " . $e->getMessage() . "\n";
}

echo "=== Fim dos exemplos ===\n";