<?php

declare(strict_types=1);

namespace ControlStructureTest\ControlStructuresUnderTest;

use function ControlStructureTest\ControlStructuresUnderTest\StringValidating\isNotAlphanumeric;

function foreachByRef(array $chars): bool {
    foreach ($chars as &$chr) {
        $chr_code = mb_ord($chr);
        if (isNotAlphanumeric($chr_code)) return false;
    }
    return true;
}
