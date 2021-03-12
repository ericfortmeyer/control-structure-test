<?php

declare(strict_types=1);

namespace ControlStructureTest;

$label_names = array_map(fn (string $filename) => basename($filename, ".php"), glob(DIRECTORY_TO_SYSTEMS_UNDER_TEST . "/*.php"));
$function_names = array_map(fn (string $function_name) => join("\\", [NAMESPACE_OF_SYSTEMS_UNDER_TEST, $function_name]) , $label_names);

return array_combine($function_names, $label_names);
