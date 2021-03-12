<?php

declare(strict_types=1);

namespace ControlStructureTest\TestPrinting\Configuration;

final class PrintResultConfig
{
    public $results_to_print = [];
    public $test_iterations = PHP_FLOAT_MIN;
    public $execution_time_for_tests = PHP_FLOAT_MIN;

    public function __construct(array $results, float $iterations_run, float $execution_time)
    {
        $this->results_to_print = $results;
        $this->test_iterations = $iterations_run;
        $this->execution_time_for_tests = $execution_time;
    }

    public function getResults(): array
    {
        return $this->results_to_print;
    }

    public function getTestIterations(): float
    {
        return $this->test_iterations;
    }

    public function getExecutionTimeForTests(): float
    {
        return $this->execution_time_for_tests;
    }
}
