<?php

declare(strict_types=1);

namespace ControlStructureTest\TestCases;

define("ControlStructureTest\TestCases\ALPHANUMERIC_CHARS", array_merge(range("0", "9"), range("A", "Z"), range("a", "z")));
define("ControlStructureTest\TestCases\LENGTH_OF_RANDOM_STRINGS", 5);
define("ControlStructureTest\TestCases\TOTAL_STRING_LENGTH", 50000);
define("ControlStructureTest\TestCases\RANDOM_SUBSTRING_ITERATIONS", intdiv(TOTAL_STRING_LENGTH, LENGTH_OF_RANDOM_STRINGS));
define("ControlStructureTest\TestCases\PASSING_STRING", "eiehowiehf02349230482039jfiowejewiojSDEW");
define("ControlStructureTest\TestCases\FAILING_STRING", "eowifjqwef23984j2fjqwoiufsjv9qw84jh98234jfh98!");
define("ControlStructureTest\TestCases\EARLY_FAILING_STRING", "*");
define("ControlStructureTest\TestCases\MUTLTIBYTE_STRING", "what∂∑˚ƒ´∆ˆ´øƒ");
define("ControlStructureTest\TestCases\STATIC_TEST_CASES",
    [
        "passing string" => PASSING_STRING,
        "failing string" => FAILING_STRING,
        "early failing string" => EARLY_FAILING_STRING,
        "multibyte string" => MUTLTIBYTE_STRING
    ]);

$long_passing_string = (function () {
    $getRandomAlnums = function () {
        $getCharacter = function (int $key) {
            return ALPHANUMERIC_CHARS[$key];
        };
        return join("", array_map($getCharacter, array_rand(ALPHANUMERIC_CHARS, LENGTH_OF_RANDOM_STRINGS)));
    };
    return join("", array_map($getRandomAlnums, range(1, RANDOM_SUBSTRING_ITERATIONS)));
})();

$testCases = array_merge(
    compact("long_passing_string"),
    STATIC_TEST_CASES
);

return [
    $testCases,
    array_map(function ($str) { return str_replace("_", " ", $str); }, array_keys($testCases))
];
