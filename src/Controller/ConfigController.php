<?php 

namespace Financas\Controller;

use Financas\Entity\User;
use Financas\Entity\UserConfig;
use Financas\Enum\Language;
use Financas\Helper\FlashMessage;
use Financas\Helper\RenderHtml;
use Financas\Helper\Route;
use Financas\Helper\Session;

class ConfigController extends Controller
{
    public function view(): void
    {
        /** @var User */
        $user = $_SESSION['logged'];

        RenderHtml::render(
            'Config/Index.php', [
                'title' => translate('Configurations'),
                'user'  => $user
            ]
        );
    }

    public function store(): void
    {
        $post = $this->post();

        try {
            /** @var User */
            $user = $this->em->getRepository(User::class)
                ->find($_SESSION['logged']->getId());

            if ($user->getConfigs()) {
                $userConfig = $user->getConfigs();
            } else {
                $userConfig = new UserConfig();
                $userConfig->setUser($user);
            }

            $userConfig->setLanguage(Language::from(($post['language']))->value);

            $this->em->persist($userConfig);
            $this->em->flush();

            Session::put($user);
            
            FlashMessage::message(
                'success', 
                translate('Config saved with successfully')
            );

            Route::redirect('config');
        } catch (\Throwable $e) {
            FlashMessage::message(
                'danger', 
                $e->getMessage()
            );

            RenderHtml::render(
                'Config/Index.php', [
                    'title' => translate('Configutations'),
                ]
            );
        }
    }
}