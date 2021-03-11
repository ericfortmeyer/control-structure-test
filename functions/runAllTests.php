<?php

declare(strict_types=1);

define('TEST_ITERATIONS', 1E+4);

function getFunctionNames(): array {
    return array_map(function ($file) { return basename($file, ".php"); }, glob('functions/functions_to_test/*.php'));
}

function testFunction(callable $function, string $arg, string $label_for_display): float {
    $max = PHP_INT_MIN;
    $min = PHP_INT_MAX;
    $sum = 0;
    if ($function <> "regex") $arg = preg_split('//u', $arg, -1, PREG_SPLIT_NO_EMPTY);
    for ($i = 0; $i < TEST_ITERATIONS; ++$i) {
        $result =- hrtime(true);
        $function($arg);
        $result += hrtime(true);
        $max = $max > $result ? $max : $result;
        $min = $min < $result ? $min : $result;
        $sum += $result;
    }
    $average = $sum / TEST_ITERATIONS;
    
    echo <<<TEST_RESULT
    ${label_for_display}:
        max     ${max}
        min     ${min}
        average ${average}


TEST_RESULT;
    return $average;
}

function doTests(string $str, string $label_for_argument): void {
    $function_names = getFunctionNames();
    $tests_and_labels = array_combine($function_names, $function_names);
    echo "TEST using ${label_for_argument} as an argument" . PHP_EOL . PHP_EOL;
    $min = PHP_INT_MAX;
    $winner_so_far = "";
    foreach ($tests_and_labels as $test => $label) {
        $average_for_this_function = testFunction($test, $str, $label);
        if ($min < $average_for_this_function) {
            continue;
        }
        $min = $average_for_this_function;
        $winner_so_far = $label;
    }
    echo "The winner is ${winner_so_far} averaging ${min}" . PHP_EOL . PHP_EOL;
}


function runAllTests(array $test_cases, array $labels_for_arguments): array {
    $function_names = getFunctionNames();
    $tests_and_labels = array_combine($function_names, $function_names);
    ob_start();
    $execution_time_for_tests =- hrtime(true);
    array_map('doTests', $test_cases, $labels_for_arguments);
    $execution_time_for_tests += hrtime(true);
    $test_functions = array_keys($tests_and_labels);
    $test_iterations = TEST_ITERATIONS * count($test_functions) * count($test_cases);
    return [ob_get_clean(), $test_iterations, $execution_time_for_tests *= 1e-9];
}