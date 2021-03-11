<?php

declare(strict_types=1);

namespace ControlStructureTest\SystemsUnderTest;

function regex(string $str): bool {
    return 0 === preg_match("/[[:^alnum:]]+/", $str);
}
