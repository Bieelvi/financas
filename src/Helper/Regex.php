<?php 

namespace Financas\Helper;

class Regex 
{
    public static function valid(int|string $string): bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9, -àáâãéêíóôõúüç]+$/u', $string);
    }
}