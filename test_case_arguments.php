<?php

declare(strict_types=1);

namespace ControlStructureTest;

/**
 * Order is important
 */
include "test_case_constants.php";
$function_names = include "test_case_names.php";

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
    array_map(function ($str) { return str_replace("_", " ", $str); }, array_keys($testCases)),
    $function_names
];
