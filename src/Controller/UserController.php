<?php

namespace Financas\Controller;

use Financas\Helper\{Encryption, FlashMessage, RenderHtml, Response, Route, Session};
use Financas\Mail\{Mail, RenderHtmlToEmail, SendMail};
use Financas\Entity\User;

class UserController extends Controller
{
    public function view(): void
    {
        /** @var User */
        $user = $_SESSION['logged'];

        RenderHtml::render(
            'Profile/Index.php', [
                'title' => translate('User'),
                'user'  => $user
            ]
        );
    }

    public function validate(): void
    {
        /** @var User */
        $user = $_SESSION['logged'];

        $date = (new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')))
            ->add(new \DateInterval('PT10M'))
            ->format('Y-m-d H:i:s');

        $json = json_encode([
            'date-expiration' => $date,
            'email' => $user->getEmail()
        ]);

        $html = RenderHtmlToEmail::validateEmail(
            'ValidateEmail.php', 
            Encryption::encryption($json)
        );

        try {
            (new SendMail())->send(new Mail(
                to: $user->getEmail(),
                toName: $user->getName(),
                subject: 'Email Validation',
                body: $html,
                isHtml: true
            ));

            Response::json([
                'data' => translate('Email sended successfully')
            ], 200);
        } catch (\Throwable $e) {
            Response::json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function validation(): void
    {
        $get  = $this->get();
        $data = json_decode(Encryption::decryption($get['code']), true);
        $tz   = new \DateTimeZone('America/Sao_Paulo');
        $date = new \DateTime($data['date-expiration'], $tz);
        $diff = $date->diff(new \DateTime('now', $tz));

        if ($diff->format("%R") === '+') {
            FlashMessage::message(
                'danger', 
                translate('Expired code')
            );
    
            Route::redirect('home');
        }
        
        /** @var User */
        $user = $this->em->getRepository(User::class)->findOneBy([
            'email' => $data['email']
        ]);
        
        $user->setValidateEmail(true);

        $this->em->persist($user);
        $this->em->flush();

        Session::strip();
        Session::put($user);

        FlashMessage::message(
            'success', 
            translate('Email validated successfully')
        );

        Route::redirect('home');
    }

    public function updatePassword(): void
    {
        $post = $this->post();

        try {
            /** @var User */
            $user = $this->em
                ->getRepository(User::class)
                ->find($_SESSION['logged']->getId());

            $user->verifyPassword($post['actualPassword']);
            $user->setPassword($user->hashPassword($post['newPassword']));
            
            $this->em->persist($user);
            $this->em->flush();
            
            Session::strip();
            Session::put($user);
            
            (new SendMail())->send(new Mail(
                to: $user->getEmail(),
                toName: $user->getName(),
                subject: translate('Password updated'),
                body: translate('Password updated successfully'),
                isHtml: false
            ));

            Response::json([
                'data' => translate('Password updated successfully')
            ], 200);
        } catch (\Throwable $e) {
            Response::json([
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function updateEmail(): void
    {
        $post = $this->post(); 

        try {
            /** @var User */
            $user = $this->em
                ->getRepository(User::class)
                ->find($_SESSION['logged']->getId());

            $user->verifyPassword($post['password']);
            $user->setEmail($post['newEmail'])
                ->setValidateEmail(false);

            $this->em->persist($user);
            $this->em->flush();
            
            Session::strip();
            Session::put($user);
            
            (new SendMail())->send(new Mail(
                to: $user->getEmail(),
                toName: $user->getName(),
                subject: translate('Email updated'),
                body: translate('Email updated successfully'),
                isHtml: false
            ));

            Response::json([
                'data' => translate('Email updated successfully')
            ], 200);
        } catch (\Throwable $e) {
            Response::json([
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
