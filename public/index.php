<?php

declare(strict_types=1);

use Dotenv\Dotenv;

include_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->safeLoad();

require_once __DIR__ . '/../bootstrap.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Financas\Helper\{FlashMessage, RenderHtml, Route, Session};

session_start();

/** Verifica se existe o PATH_INFO */
if (!isset($_SERVER['PATH_INFO'])) {
	Route::redirect('home');
}

/** Pega a rota chamada */
$path = $_SERVER['PATH_INFO'];

/** Busca as rotas cadastradas */
$routes = require __DIR__ . '/../config/Routes.php';

/** Verifica a rota existe */
if (!array_key_exists($path, $routes)){
	RenderHtml::render('NotLogged/PageNotFound.php');
}

/** Verifica se o metodo da rota chamado esta certo */
if ($_SERVER['REQUEST_METHOD'] !== $routes[$path][0]) {
	FlashMessage::message(
		'danger',
		'Method not allowed'
	);

	Route::redirect('home');
}

/** Verifica se o usuario esta logado e verifica o nivel de acesso da rota */
if (!Session::has() && !$routes[$path][3]) {
	Route::redirect('home');
}

/** Busca a classe referente a rota */
$controllerClass = $routes[$path];

/** Cria a classe passando no constructor o EntityManeger */
$controller = new $controllerClass[1]($entityManager);

/** Chama o metodo */
$controller->{"$controllerClass[2]"}();
