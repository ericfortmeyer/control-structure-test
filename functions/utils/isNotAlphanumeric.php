<?php

declare(strict_types=1);

$ascii_special_chars_codes = array_merge(range(58, 64), range(91, 96));

define('ASCII_SPECIAL_CHARS', $ascii_special_chars_codes);
define('MIN_CHAR_CODE', 48);
define('MAX_CHAR_CODE', 122);

function isNotAlphanumeric(int $character_code) {
    return $character_code < MIN_CHAR_CODE
        || $character_code > MAX_CHAR_CODE
        || in_array($character_code, ASCII_SPECIAL_CHARS);
}
