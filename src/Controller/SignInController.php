<?php 

namespace Financas\Controller;

use Financas\Entity\User;
use Financas\Helper\FlashMessage;
use Financas\Helper\RenderHtml;
use Financas\Helper\Route;
use Financas\Helper\Session;

class SignInController extends Controller
{
    public function view(): void
    {
        if (Session::has()) {
            Route::redirect('home');
        }

        RenderHtml::render(
            'SignIn/Index.php', [
                'title' => translate('signin'),
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
                ->findOneByEmail([
                    'email' => $post['email']
                ]);
            
            $user->verifyPassword($post['password']);

            $user->setRememberPassword(isset($post['remember-password']) ?? true)
                ->setLastLoginAt(new \DateTime('now', new \DateTimeZone($user->getConfigs()->getTimezone())));

            $this->em->persist($user);
            $this->em->flush();

            Session::put($user);

            FlashMessage::message(
                'success', 
                translate('Logged in successfully')
            );

            Route::redirect('home');
        } catch (\Throwable $e) {
            FlashMessage::message(
                'danger', 
                $e->getMessage()
            );
            
            Route::redirect('signin');
        }
    }
}