<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

require 'vendor/autoload.php';
require 'dao/TeachersDAO.php';

$app = new \Slim\App;
$teachersDAO = new TeachersDAO();

$app->get('/{anything:.*}', function($request, $response, $args) {
	$view = new \Slim\Views\PhpRenderer('view/');
	$basePath = $request->getUri()->getBasePath();
	return $view->render($response, 'home.php', ['basePath' => $basePath]);
});

$app->get('/api/teachers/?', function($teachersDAO) {
    header('Content-Type: application/json');
    echo json_encode($teachersDAO->getTeachers());
    exit();
});

$app->run();