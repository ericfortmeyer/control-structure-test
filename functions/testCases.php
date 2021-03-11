<?php

declare(strict_types=1);

function getTestCases() {
    $passing_string = "eiehowiehf02349230482039jfiowejewiojSDEW";
    $failing_string = "eowifjqwef23984j2fjqwoiufsjv9qw84jh98234jfh98!";
    $early_failing_string = "*";
    $long_passing_string = join("", array_reduce(range(0, 10000), function ($carry) { return array_merge($carry, array_map('chr', array_rand(array_merge(range(48, 58), range(65, 90), range(96, 122)), 5))); }, []));
    $multibyte_string = "what∂∑˚ƒ´∆ˆ´øƒ";
    $testCases = compact(
        'passing_string',
        'failing_string',
        'early_failing_string',
        'long_passing_string',
        'multibyte_string'
    );
    return [
        $testCases,
        array_map(function ($str) { return str_replace('_', ' ', $str); }, array_keys($testCases))
    ];
}
