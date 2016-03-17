<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

require 'vendor/autoload.php';
require 'dao/TeachersDAO.php';

$app = new \Slim\App;
$teachersDAO = new TeachersDAO();

$app->get('/', function($request, $response, $args) {
	$view = new \Slim\Views\PhpRenderer('view/');
	$basePath = $request->getUri()->getBasePath();
	return $view->render($response, 'home.php', ['basePath' => $basePath]);
});

$app->get('/api/teachers', function() use ($teachersDAO) {
    header('Content-Type: application/json');
    echo json_encode($teachersDAO->getTeachers());
    exit;
});

$app->get('/api/teachers', function() use ($teachersDAO) {
    header('Content-Type: application/json');
    echo json_encode($teachersDAO->getTeachers());
    exit;
});

$app->put('/api/teachers/{id}/approve', function ($request, $response, $args) {
  //$teachersDAO = new TeachersDAO();
  $updatedTeacher = $teacherDAO->approveTeacher($args['id']);
  $response = $response->write(json_encode($updatedTeacher))
    ->withHeader('Content-Type','application/json');
  if(empty($updatedTeacher)) {
    $response = $response->withStatus(404);
  }
  return $response;
});

$app->delete('/api/teachers/{id}', function ($request, $response, $args) {
  //$teachersDAO = new TeachersDAO();
  $teachersDAO->deleteTeacher($args['id']);
  return $response->write(true)
    ->withHeader('Content-Type','application/json');
});

$app->run();
