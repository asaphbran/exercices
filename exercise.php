<?php
declare(strict_types=1);

/**
 * Ejercicio: Generar una pirámide numérica a partir de un valor inicial ($start).
 *
 * Lógica
 * Cada fila i muestra:
 *   Descendente: S*i, S*(i-1), ..., S*1
 *   Ascendente:  S*2, S*3, ..., S*i
 * donde S = $start y los valores se concatenan sin separador.
 *
 * Complejidad:
 *  - Tiempo: O(n²) → Cada fila i genera ~2i números, y la suma de 1 a n nos da n².
 *  - Espacio: O(n²) si almacenamos todas las filas en memoria.
 *             Optimizado a O(n) imprimiendo directamente las filas (ver parámetro $center=false).
 *
 * Contexto del error original:
 *  En el enunciado proporcionado, a partir de la fila 6 (caso S=3) y en adelante, se introdujeron errores
 *  como "181151296369121518" en lugar de "18151296369121518". Esto ocurrió debido a la transcripción manual
 *  de números concatenados, provocando la inserción o pérdida de dígitos, especialmente con números de dos dígitos como 15 y 18.
 *  El error se repite en las filas superiores.
 *
 * Corrección:
 *  Aquí, cada fila se construye algorítmicamente con bucles y multiplicaciones,
 *  asegurando que el patrón sea exacto y evitando errores en la concatenación.
 *  El código usa implode para concatenar todas las partes en una sola cadena,
 *  lo cual es eficiente y evita errores manuales en la concatenación.
 */

/**
 * Generar la línea $i para un valor base $start:
 *   Descendente: S*i, S*(i-1), ..., S*1
 *   Ascendente:  S*2, S*3, ..., S*i
 */
function build_line(int $start, int $i): string {
    $parts = [];
    // Descendente
    for ($j = $i; $j >= 1; $j--) {
        $parts[] = (string)($start * $j);
    }
    // Ascendente
    for ($j = 2; $j <= $i; $j++) {
        $parts[] = (string)($start * $j);
    }
    // Concatenacion sin separador
    // Esto evita problemas con errores de concatenación manual.
    // Usando implode para concatenar todas las partes en una sola cadena.
    // Esto es eficiente y evita errores manuales en la concatenación.
    return implode('', $parts);
}

/**
 * Genera la piramide
 * Si $center es true, devuelve todas las líneas centradas (O(n²) espacio).
 * Si $center es false, imprime línea por línea (O(n) espacio).
 */
function generate_pyramid(int $start, int $rows = 10, bool $center = true): array {
    if (!$center) {

        // Modo optimizado en memoria: imprime línea por línea
        // Esto evita almacenar todas las líneas en memoria, usando O(n) espacio.
        for ($i = 1; $i <= $rows; $i++) {
            echo build_line($start, $i) . PHP_EOL;
        }
        return [];
    }

    // Modo centrado: guarda todas las filas en memoria
    $lines = [];
    for ($i = 1; $i <= $rows; $i++) {
        $lines[] = build_line($start, $i);
    }
    // Calcular padding para centrar
    $maxLen = max(array_map('strlen', $lines));
    foreach ($lines as &$line) {
        $leftPad = (int) floor(($maxLen - strlen($line)) / 2);
        $line = str_repeat(' ', $leftPad) . $line;
    }
    unset($line);

    return $lines;
}

/* ---------- Punto de entrada (CLI or Web) ---------- */
if (php_sapi_name() === 'cli') {
    // CLI: php exercise.php start rows [center]
    // Ejemplo real: php exercise.php 3 10 true
    $start  = isset($argv[1]) ? (int)$argv[1] : 1;
    $rows   = isset($argv[2]) ? (int)$argv[2] : 10;
    $center = isset($argv[3]) ? filter_var($argv[3], FILTER_VALIDATE_BOOLEAN) : true;

    $lines = generate_pyramid($start, $rows, $center);
    if ($center) {
        foreach ($lines as $ln) {
            echo $ln . PHP_EOL;
        }
    }
} else {
    // Web: exercise.php?start=3&rows=10&center=true
    $start  = isset($_GET['start']) ? (int)$_GET['start'] : 1;
    $rows   = isset($_GET['rows'])  ? (int)$_GET['rows']  : 10;
    $center = isset($_GET['center']) ? filter_var($_GET['center'], FILTER_VALIDATE_BOOLEAN) : true;

    $lines = generate_pyramid($start, $rows, $center);
    echo '<pre style="font-family:monospace">';
    if ($center) {
        foreach ($lines as $ln) {
            echo htmlspecialchars($ln, ENT_QUOTES, 'UTF-8') . PHP_EOL;
        }
    }
    echo '</pre>';
}
