<?php

/**
 * Estrutura do array
 * [nome da rota] => [metodo da rota, controller, metodo do controller, rota publica]
 */
return [
    '/home'                => ['GET', Financas\Controller\HomeController::class, 'view', true],
   
    '/signup'              => ['GET', Financas\Controller\SignUpController::class, 'view', true],
    '/user/store'          => ['POST', Financas\Controller\SignUpController::class, 'store', true],

    '/signin'              => ['GET', Financas\Controller\SignInController::class, 'view', true],
    '/signin/store'        => ['POST', Financas\Controller\SignInController::class, 'store', true],
     
    '/logout'              => ['GET', Financas\Controller\LogoutController::class, 'logout', true],

    '/validate-email'      => ['GET', Financas\Controller\UserController::class, 'validate', false],
    '/validate-email/code' => ['GET', Financas\Controller\UserController::class, 'validation', false],
    '/update-email'        => ['POST', Financas\Controller\UserController::class, 'updateEmail', false],
    '/update-password'     => ['POST', Financas\Controller\UserController::class, 'updatePassword', false],
    '/profile'             => ['GET', Financas\Controller\UserController::class, 'view', false],

    '/products'            => ['GET', Financas\Controller\ProductController::class, 'view', false],
    '/products/store'      => ['POST', Financas\Controller\ProductController::class, 'store', false],
    '/products/delete'     => ['POST', Financas\Controller\ProductController::class, 'delete', false],

    '/farmer'              => ['GET', Financas\Controller\FarmerController::class, 'view', false],
    '/farmer/show'         => ['GET', Financas\Controller\FarmerController::class, 'show', false],
    '/farmer/edit'         => ['POST', Financas\Controller\FarmerController::class, 'edit', false],
    '/farmer/store'        => ['POST', Financas\Controller\FarmerController::class, 'store', false],
    '/farmer/delete'       => ['POST', Financas\Controller\FarmerController::class, 'delete', false],

    '/report'              => ['GET', Financas\Controller\ReportController::class, 'view', false],
    
    '/session'             => ['POST', Financas\Controller\SessionController::class, 'session', true],
    '/session/unset'       => ['POST', Financas\Controller\SessionController::class, 'unsetSession', true],

    '/config'              => ['GET', Financas\Controller\ConfigController::class, 'view', false],
    '/config/store'        => ['POST', Financas\Controller\ConfigController::class, 'store', false],
];