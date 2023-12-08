<?php 

namespace Financas\Report;

interface Report
{
    public function generate(): void;

    public function data(): array;
}