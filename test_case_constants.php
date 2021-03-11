<?php

declare(strict_types=1);

namespace ControlStructureTest;

define("NAMESPACE_OF_SYSTEMS_UNDER_TEST", "ControlStructureTest\SystemsUnderTest");
define("DIRECTORY_TO_SYSTEMS_UNDER_TEST", "systems-under-test");
define("ControlStructureTest\ALPHANUMERIC_CHARS", array_merge(range("0", "9"), range("A", "Z"), range("a", "z")));
define("ControlStructureTest\LENGTH_OF_RANDOM_STRINGS", 5);
define("ControlStructureTest\TOTAL_STRING_LENGTH", 50000);
define("ControlStructureTest\RANDOM_SUBSTRING_ITERATIONS", intdiv(TOTAL_STRING_LENGTH, LENGTH_OF_RANDOM_STRINGS));
define("ControlStructureTest\PASSING_STRING", "eiehowiehf02349230482039jfiowejewiojSDEW");
define("ControlStructureTest\FAILING_STRING", "eowifjqwef23984j2fjqwoiufsjv9qw84jh98234jfh98!");
define("ControlStructureTest\EARLY_FAILING_STRING", "*");
define("ControlStructureTest\MUTLTIBYTE_STRING", "what∂∑˚ƒ´∆ˆ´øƒ");
define("ControlStructureTest\STATIC_TEST_CASES",
    [
        "passing string" => PASSING_STRING,
        "failing string" => FAILING_STRING,
        "early failing string" => EARLY_FAILING_STRING,
        "multibyte string" => MUTLTIBYTE_STRING
    ]);

