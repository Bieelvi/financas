<?php 

namespace Financas\Controller;

use Financas\Entity\User;
use Financas\Helper\FlashMessage;
use Financas\Helper\RenderHtml;
use Financas\Helper\Route;
use Financas\Helper\Session;

class SignInController extends Controller
{
    private string $pageName = 'signin';

    public function view(): void
    {
        if (Session::has()) {
            Route::redirect('home');
        }

        RenderHtml::render(
            'SignIn/Index.php', [
                'title' => $this->pageName,
            ]
        );
    }

    public function store(): void
    {
        $post = $this->post();

        try {
            /** @var User */
            $user = $this->em
                ->getRepository(User::class)
                ->findOneBy([
                    'email' => $post['email']
                ]);
            $user->verifyPassword($post['password']);

            $user->setRememberPassword($post['remember-password'])
                ->setLastLoginAt(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')));

            $this->em->persist($user);
            $this->em->flush();

            Session::put($user);

            FlashMessage::message(
                'success', 
                'Logged in successfully'
            );

            Route::redirect('home');
        } catch (\Throwable $e) {
            FlashMessage::message(
                'danger', 
                $e->getMessage()
            );
            
            Route::redirect('signIn');
        }
    }
}