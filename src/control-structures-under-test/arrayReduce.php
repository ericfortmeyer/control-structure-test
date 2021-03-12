<?php

declare(strict_types=1);

namespace ControlStructureTest\ControlStructuresUnderTest;

use function ControlStructureTest\ControlStructuresUnderTest\StringValidating\isNotAlphanumeric;

function checkNextCharacter(bool $previous_result, string $chr) {
    $chr_code = mb_ord($chr);
    return $previous_result
        && false === (isNotAlphanumeric($chr_code));
}

function arrayReduce(array $chars): bool {
    return array_reduce(
        $chars,
        __NAMESPACE__ . "\checkNextCharacter",
        true
    );
}
