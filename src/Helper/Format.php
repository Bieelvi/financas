<?php 

namespace Financas\Helper;

class Format
{
    public static function float(float $value): string
    {
        return number_format($value, 2, ',', '.');
    }
}