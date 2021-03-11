<?php

declare(strict_types=1);

namespace ControlStructureTest\SystemsUnderTest\ValidatingLogic;

define("ControlStructureTest\SystemsUnderTest\ValidatingLogic\ASCII_SPECIAL_CHARS", array_merge(range(58, 64), range(91, 96)));
/* Optimizing by using a set */
define("ControlStructureTest\SystemsUnderTest\ValidatingLogic\ASCII_SPECIAL_CHARS_HASH_SET", array_combine(ASCII_SPECIAL_CHARS, ASCII_SPECIAL_CHARS));
define("ControlStructureTest\SystemsUnderTest\ValidatingLogic\MIN_CHAR_CODE", 48);
define("ControlStructureTest\SystemsUnderTest\ValidatingLogic\MAX_CHAR_CODE", 122);

function isNotAlphanumeric(int $character_code) {
    return $character_code < MIN_CHAR_CODE
        || $character_code > MAX_CHAR_CODE
        || isset(ASCII_SPECIAL_CHARS_HASH_SET[$character_code]);
}
