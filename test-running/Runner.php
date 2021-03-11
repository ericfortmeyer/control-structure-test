<?php

declare(strict_types=1);

namespace ControlStructureTest\TestRunning;

final class Runner
{
    private const TEST_ITERATIONS = 1E+2;
    private const SYSTEMS_UNDER_TEST_NAMESPACE = "ControlStructureTest\SystemsUnderTest";
    private const FUNCTIONS_WITH_STRING_ARGS = [ self::SYSTEMS_UNDER_TEST_NAMESPACE . "\\" . "regex" ];
    
    private static function testFunction(callable $function, string $arg): array
    {
        $max = PHP_INT_MIN;
        $min = PHP_INT_MAX;
        $sum = 0;
        if (false === in_array($function, self::FUNCTIONS_WITH_STRING_ARGS)) $arg = preg_split("//u", $arg, -1, PREG_SPLIT_NO_EMPTY);
        for ($i = 0; $i < self::TEST_ITERATIONS; ++$i) {
            $result =- hrtime(true);
            $function($arg);
            $result += hrtime(true);
            $max = $max > $result ? $max : $result;
            $min = $min < $result ? $min : $result;
            $sum += $result;
        }
        $average = intdiv($sum, intval(self::TEST_ITERATIONS));
        return [$max, $min, $average];
    }
    
    private static function coverEachTestCase(string $str, string $label_for_argument, array $tests_and_labels): array
    {
        $result["label"] = $label_for_argument;
        $min = PHP_INT_MAX;
        $winner_so_far = "";
        foreach ($tests_and_labels as $test => $label) {
            [$max_for_this_function, $min_for_this_function, $average_for_this_function] =
                self::testFunction($test, $str);
            $result["results"][] = [$label, $max_for_this_function, $min_for_this_function, $average_for_this_function];
            if ($min < $average_for_this_function) {
                continue;
            }
            $min = $average_for_this_function;
            $winner_so_far = $label;
        }
        $winner = $winner_so_far;
        $result["winner_info"] = [$winner, $min];
        return $result;
    }
    
    static function runAllTestsWith(array $test_cases, array $labels_for_arguments, array $tests_and_labels): array
    {
        $execution_time_for_tests =- hrtime(true);
        $coverTestCases = function (string $str, string $label_for_argument) use ($tests_and_labels): array {
            return self::coverEachTestCase($str, $label_for_argument, $tests_and_labels);
        };
        $results = array_map($coverTestCases, $test_cases, $labels_for_arguments);
        $execution_time_for_tests += hrtime(true);
        $test_functions = array_keys($tests_and_labels);
        $test_iterations = self::TEST_ITERATIONS * count($test_functions) * count($test_cases);
        return [$results, $test_iterations, $execution_time_for_tests *= 1E-9];
    }
}
