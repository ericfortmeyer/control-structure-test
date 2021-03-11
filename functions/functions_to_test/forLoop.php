<?php

declare(strict_types=1);

function forLoop(string $str): bool {
    for ($i = 0, $length = strlen($str); $i < $length; ++$i) {
        $character_code_of_current = mb_ord($str[$i]);
        if (isNotAlphanumeric($character_code_of_current)) return false;
    }
    return true;
}
