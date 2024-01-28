<?php 

namespace Financas\Mail;

class RenderHtmlToEmail
{
    final public const TEMPLATE_MAIL = "/../../View/Template/Mail/";
    
    public static function validateEmail(string $path, string $crypto): string
    {
        $urlValidate = "validate-email/code?code={$crypto}";

        return require __DIR__ . self::TEMPLATE_MAIL . "{$path}";
    }
}