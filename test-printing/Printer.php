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
            $config->getResults(),
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
