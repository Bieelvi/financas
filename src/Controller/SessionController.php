<?php

namespace Financas\Controller;

use Financas\Helper\Response;

class SessionController extends Controller
{
    public function session(): void
    {
        $session = isset($_SESSION['flash_message']);

        Response::json([
            'data' => $session ? $_SESSION['flash_message'] : translate('No message')
        ], $session ? 200 : 404);
    }

    public function unsetSession(): void
    {
        $post = $this->post();

        if (isset($_SESSION[$post['unset']])) {
            unset($_SESSION[$post['unset']]);

            Response::json([
                'data' => translate('Unset session successfully')
            ], 200);
        }

        Response::json([
            'data' => 'No message'
        ], 404);
    }
}
