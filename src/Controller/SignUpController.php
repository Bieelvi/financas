<?php 

namespace Financas\Controller;

use Financas\Entity\User;
use Financas\Helper\FlashMessage;
use Financas\Helper\RenderHtml;
use Financas\Helper\Route;
use Financas\Helper\Session;

class SignUpController extends Controller
{
    private string $pageName = 'signup';

    public function view(): void
    {
        if (Session::has()) {
            Route::redirect('home');
        }

        RenderHtml::render(
            'SignUp/Index.php', [
                'title' => $this->pageName,
            ]
        );
    }

    public function store(): void
    {
        $post = $this->post();

        try {
            $user = new User();
            $user->compare($post['password'], $post['confirm-password']);
            
            $user->setName($post['name'])
                ->setEmail($post['email'])
                ->setPassword($user->hashPassword($post['password']));

            $this->em->persist($user);
            $this->em->flush();

            FlashMessage::message(
                'success', 
                'User saved with successfully'
            );

            Route::redirect('home');
        } catch (\Throwable $e) {
            FlashMessage::message(
                'danger', 
                $e->getMessage()
            );

            RenderHtml::render(
                'SignUp/Index.php', [
                    'title' => $this->pageName
                ]
            );
        }
    }
}