<?php

declare(strict_types=1);

namespace ControlStructureTest\TestRunning;

final class Runner
{
    private const TEST_ITERATIONS = 1E+2;
    private const SYSTEMS_UNDER_TEST_NAMESPACE = "ControlStructureTest\ControlStructuresUnderTest";
    private const FUNCTIONS_WITH_STRING_ARGS = [ self::SYSTEMS_UNDER_TEST_NAMESPACE . "\\" . "regex" ];
    
    public static function runAllTestsWith(array $test_cases, array $labels_for_arguments, array $functions_to_test_with_their_names): array
    {
        $total_execution_time_for_tests =- hrtime(true);
        $results = array_map(self::coverTestCasesFor($functions_to_test_with_their_names), $test_cases, $labels_for_arguments);
        $total_execution_time_for_tests += hrtime(true);
        $test_functions = array_keys($functions_to_test_with_their_names);
        $total_test_iterations = self::TEST_ITERATIONS * count($test_functions) * count($test_cases);
        return [$results, $total_test_iterations, $total_execution_time_for_tests *= 1E-9];
    }

    private static function coverTestCasesFor(array $tests_and_labels): \Closure
    {
        return function (string $given_string_argument, string $label_for_arguments) use ($tests_and_labels): array {
            return self::coverEachTestCase($given_string_argument, $label_for_arguments, $tests_and_labels);
        };
    }

    private static function testSingleIteration(callable $function, string $arg): void
    {
        if (self::shouldNotBeRunWithStringArgument($function)) {
            $function(self::stringToArray($arg));
        } else {
            $function($arg);
        }
    }

    private static function shouldNotBeRunWithStringArgument(callable $function): bool
    {
        return false === in_array($function, self::FUNCTIONS_WITH_STRING_ARGS);
    }

    private static function stringToArray(string $str): array
    {
        return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    }
    
    private static function testFunction(callable $function, string $arg): array
    {
        $max = PHP_INT_MIN;
        $min = PHP_INT_MAX;
        $sum = 0;
        for ($i = 0; $i < self::TEST_ITERATIONS; ++$i) {
            $result =- hrtime(true);
            self::testSingleIteration($function, $arg);
            $result += hrtime(true);
            $max = $max > $result ? $max : $result;
            $min = $min < $result ? $min : $result;
            $sum += $result;
        }
        $average = self::getAverageFromSum($sum);
        return [$max, $min, $average];
    }

    private static function getAverageFromSum(int $sum): int
    {
        return intdiv($sum, intval(self::TEST_ITERATIONS));
    }
    
    private static function coverEachTestCase(string $given_string_argument, string $label_for_argument, array $tests_and_labels): array
    {
        $min = PHP_INT_MAX;
        $winner = "";
        return [
            "results" => array_map(self::getResults($given_string_argument, $min, $winner), array_keys($tests_and_labels), $tests_and_labels),
            "label" => $label_for_argument,
            "winner_info" => [$winner, $min]
        ];
    }

    private static function getResults(string $given_string_argument, int &$min, string &$winner): \Closure
    {
        return function (callable $function_under_test, string $name_of_function_under_test) use ($given_string_argument, $min, $winner): array {
            [$max_for_this_function, $min_for_this_function, $average_for_this_function] =
                self::testFunction($function_under_test, $given_string_argument);
            self::updateWinnerInfoIfFastestSoFar($min, $winner, $average_for_this_function, $name_of_function_under_test);
            return [$name_of_function_under_test, $max_for_this_function, $min_for_this_function, $average_for_this_function];
        };
    }

    private static function updateWinnerInfoIfFastestSoFar(int &$min, string &$winner, int $average_for_this_function, string $name_of_function_under_test): void
    {
        if ($min > $average_for_this_function) {
            $min = $average_for_this_function;
            $winner = $name_of_function_under_test;
        }
    }
}
