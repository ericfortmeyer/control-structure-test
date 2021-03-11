<?php

declare(strict_types=1);

namespace ControlStructureTest;

function getFunctionNames(): array
{
    return array_map("ControlStructureTest\getFunctionLabelFromFilename", glob(DIRECTORY_TO_SYSTEMS_UNDER_TEST . "/*.php"));
}

function getFunctionLabelFromFilename(string $filename): string
{
    return basename($filename, ".php");
}

function getFunctionNameFromLabel(string $function_name): string
{
    return NAMESPACE_OF_SYSTEMS_UNDER_TEST . "\\" . $function_name;
}

$label_names = getFunctionNames();
$function_names = array_map("ControlStructureTest\getFunctionNameFromLabel", $label_names);

return array_combine($function_names, $label_names);
