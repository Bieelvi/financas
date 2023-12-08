<?php 

namespace Financas\Controller;

use Financas\Helper\FlashMessage;
use Financas\Helper\Route;
use Financas\Helper\Session;

class LogoutController extends Controller
{
    public function logout(): void
    {
        Session::strip();

        FlashMessage::message(
            'success', 
            'Logout successfully'
        );

        Route::redirect('home');
    }
}