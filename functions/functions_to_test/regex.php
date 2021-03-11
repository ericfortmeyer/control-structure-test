<?php

declare(strict_types=1);

function regex(string $str): bool {
    return 0 === preg_match('/[[:^alnum:]]+/', $str);
}
