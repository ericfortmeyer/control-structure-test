<?php

declare(strict_types=1);

define("LENGTH_OF_RANDOM_STRINGS", 5);
define("TOTAL_STRING_LENGTH", 50000);
define("RANDOM_SUBSTRING_ITERATIONS", intdiv(TOTAL_STRING_LENGTH, LENGTH_OF_RANDOM_STRINGS));

function getTestCases() {
    $passing_string = "eiehowiehf02349230482039jfiowejewiojSDEW";
    $failing_string = "eowifjqwef23984j2fjqwoiufsjv9qw84jh98234jfh98!";
    $early_failing_string = "*";
    $long_passing_string = (function () {
        $alnum = array_merge(range("0", "9"), range("A", "Z"), range("a", "z"));
        $getRandomAlnums = function (int $_) use ($alnum) {
            $getCharacter = function (int $key) use ($alnum) {
                return $alnum[$key];
            };
            return join("", array_map($getCharacter, array_rand($alnum, LENGTH_OF_RANDOM_STRINGS)));
        };
        return join("", array_map($getRandomAlnums, range(1, RANDOM_SUBSTRING_ITERATIONS)));
    })();
    $multibyte_string = "what∂∑˚ƒ´∆ˆ´øƒ";
    $testCases = compact(
        "passing_string",
        "failing_string",
        "early_failing_string",
        "long_passing_string",
        "multibyte_string"
    );
    return [
        $testCases,
        array_map(function ($str) { return str_replace("_", " ", $str); }, array_keys($testCases))
    ];
}
