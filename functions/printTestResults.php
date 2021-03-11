<?php

declare(strict_types=1);

function printTestResults(string $results_to_print, float $test_iterations, float $execution_time_for_tests) {
    $php_version = PHP_VERSION;
    $php_build_os = PHP_OS;
    $result_unit_of_time = "nanoseconds";

    echo <<<HEADER
=============================================================================
CONTROL STRUCTURE EFFICIENCY TEST
=============================================================================
The tests are being used to compare the speed of a set of control structures
available to PHP.  The functions are tasked with determining if all characters
of a string are alphanumeric.  Results are in ${result_unit_of_time}.
=============================================================================




HEADER,
    $results_to_print,
    <<<FOOTER




There were ${test_iterations} calls to functions under test.
This script took ${execution_time_for_tests} seconds to run.
PHP Version: ${php_version}
PHP Build OS: ${php_build_os}
FOOTER;

}