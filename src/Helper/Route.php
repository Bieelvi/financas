<?php 

namespace Financas\Helper;

class Route
{
    public static function redirect($path): void
    {
        header("Location: /{$path}");
        exit;
    }
}