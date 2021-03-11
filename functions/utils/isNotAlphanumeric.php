<?php

declare(strict_types=1);

define("ASCII_SPECIAL_CHARS", array_merge(range(58, 64), range(91, 96)));
/* Optimizing by using a set */
define("ASCII_SPECIAL_CHARS_HASH_SET", array_combine(ASCII_SPECIAL_CHARS, ASCII_SPECIAL_CHARS));
define("MIN_CHAR_CODE", 48);
define("MAX_CHAR_CODE", 122);

function isNotAlphanumeric(int $character_code) {
    return $character_code < MIN_CHAR_CODE
        || $character_code > MAX_CHAR_CODE
        || isset(ASCII_SPECIAL_CHARS_HASH_SET[$character_code]);
}
