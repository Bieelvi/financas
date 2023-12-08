<?php

namespace Financas\Helper;

use Financas\Entity\User;

class Session
{
    const SESSION_EXPIRATION = 10;

    public static function put(User $user): void
    {
        $_SESSION['logged'] = $user;
    }

    public static function strip(): void
    {
        unset($_SESSION['logged']);
    }

    public static function has(): bool
    {
        if (!isset($_SESSION['logged'])) 
            return false;

        /** @var User */
        $user = $_SESSION['logged'];
        if ($user->getRememberPassword()) {
            return isset($_SESSION['logged']);
        }
        
        $now = new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo'));
        $interval = $user->getLastLoginAt()->diff($now);

        if ($interval->format('%i') > self::SESSION_EXPIRATION) {
            self::strip();

            FlashMessage::message(
                'danger', 
                'Necessary new login'
            );

            Route::redirect('signin');            
        }
    }
}