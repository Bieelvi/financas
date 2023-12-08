<?php 

namespace Financas\Helper;

class FlashMessage
{
    public static function message(string $type, string $message): void
    {
        $_SESSION['flash_message'] = [
            'type' => $type,
            'message' => $message
        ];
    }
}