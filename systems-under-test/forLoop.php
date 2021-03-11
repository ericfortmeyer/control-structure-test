<?php

declare(strict_types=1);

namespace ControlStructureTest\SystemsUnderTest;

use function ControlStructureTest\SystemsUnderTest\ValidatingLogic\isNotAlphanumeric;

function forLoop(array $chars): bool {
    for ($i = 0, $length = count($chars); $i < $length; ++$i) {
        $character_code_of_current = mb_ord($chars[$i]);
        if (isNotAlphanumeric($character_code_of_current)) return false;
    }
    return true;
}
