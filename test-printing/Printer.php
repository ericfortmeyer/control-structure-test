<?php

declare(strict_types=1);

namespace ControlStructureTest\TestPrinting;

use ControlStructureTest\TestPrinting\Configuration\PrintResultConfig;

final class Printer
{
    private const RESULT_UNIT_OF_TIME = "nanoseconds";

    public static function printTestResultsUsing(PrintResultConfig $config) {
        echo
            self::header(self::RESULT_UNIT_OF_TIME),
            self::printAllTestRuns($config->getResults()),
            self::footer($config);
    }

    private static function header(string $result_unit_of_time): string {
        return <<<HEADER
=============================================================================
CONTROL STRUCTURE EFFICIENCY TEST
=============================================================================
The tests are being used to compare the speed of a set of control structures
available to PHP.  The functions are tasked with determining if all characters
of a string are alphanumeric.  Results are in ${result_unit_of_time}.
=============================================================================




HEADER;
    }

    private static function printAllTestRuns(array $results): void
    {
        foreach ($results as $test_case) {
            self::printOneTestRun($test_case["label"], $test_case["results"], $test_case["winner_info"]);
        }
    }

    private static function printOneTestRun(string $label_for_argument, array $results, array $winner_info): void
    {
        self::printArgumentLabel($label_for_argument);
        foreach ($results as $result) {
            self::printTestResult(...$result);
        }
        self::printWinnerInfo($winner_info);
    }
    
    private static function printArgumentLabel(string $label_for_argument): void
    {
        echo "TEST using ${label_for_argument} as an argument" . PHP_EOL . PHP_EOL;
    }
    
    private static function printWinnerInfo(array $winner_info): void
    {
        $winner = $winner_info[0];
        $min = $winner_info[1];
        echo "The winner is ${winner} averaging ${min}" . PHP_EOL . PHP_EOL;
    }

    private static function printTestResult(string $label_for_display, int $max, int $min, int $average): void
    {
        echo <<<TEST_RESULT
    
    ${label_for_display}:
        max     ${max}
        min     ${min}
        average ${average}
    
    
TEST_RESULT;
    }


    private static function footer(PrintResultConfig $config,): string {
        $php_version = PHP_VERSION;
        $php_build_os = PHP_OS;
        return <<<FOOTER




There were {$config->getTestIterations()} calls to functions under test.
This script took {$config->getExecutionTimeForTests()} seconds to run.
PHP Version: ${php_version}
PHP Build OS: ${php_build_os}
FOOTER;
    }
}
