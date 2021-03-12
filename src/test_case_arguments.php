<?php

declare(strict_types=1);

namespace ControlStructureTest;

include "test_case_constants.php";

$long_passing_string =
    join("",
         array_map(fn () => join("",
                                 array_map(fn (int $key) => ALPHANUMERIC_CHARS[$key],
                                           array_rand(ALPHANUMERIC_CHARS, LENGTH_OF_RANDOM_STRINGS))),
         range(1, RANDOM_SUBSTRING_ITERATIONS)));

$testCases = array_merge(
    compact("long_passing_string"),
    STATIC_TEST_CASES
);

$test_information = (include "test_case_names.php");

return [
    $testCases,
    array_map(fn (string $str) => str_replace("_", " ", $str), array_keys($testCases)),
    $test_information
];
