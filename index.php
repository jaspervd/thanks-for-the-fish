<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

require 'vendor/autoload.php';
require 'dao/TeachersDAO.php';

$app = new \Slim\App;
$teachersDAO = new TeachersDAO();

/* -- Front End ------------------ */

$app->get('/', function($request, $response, $args) {
	$view = new \Slim\Views\PhpRenderer('view/');
	$basePath = $request->getUri()->getBasePath();
	return $view->render($response, 'home.php', ['basePath' => $basePath]);
});

/* -- API: Teachers -------------- */

$app->get('/api/teachers', function() use ($teachersDAO) {
    header('Content-Type: application/json');
    echo json_encode($teachersDAO->getTeachers());
    exit;
});

$app->get('/api/teachers/{id}', function($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $teacher = $teachersDAO->getTeacherById($args['id']);
  $response = $response->write(json_encode($teacher))
    ->withHeader('Content-Type','application/json');
  if(empty($oneliner)) {
    $response = $response->withStatus(404);
  }
  return $response;
});

$app->post('/api/teachers', function ($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $teacher = $request->getParsedBody();
  $insertedTeacher = $teachersDAO->insertTeacher($teacher);
  $response = $response->write(json_encode($insertedTeacher))
    ->withHeader('Content-Type','application/json');
  if(empty($insertedTeacher)) {
    $response = $response->withStatus(404);
  } else {
    $response = $response->withStatus(201);
  }
  return $response;
});

$app->post('/api/teachers/auth', function ($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $loginData = $request->getParsedBody();
  $teacher = $teachersDAO->login($loginData['email'], $loginData['password']);
  $response = $response->write(json_encode($teacher))
    ->withHeader('Content-Type','application/json');
  if(empty($teacher)) {
    $response = $response->withStatus(404);
  }else{
    session_start();
    $_SESSION['user'] = $teacher;
  }
  return $response;
});

$app->get('/api/user/{data}', function ($request, $response, $args) {
  session_start();
  if(!empty($_SESSION) && !empty($_SESSION['user'])){
    return $_SESSION['user'][$args['data']];
  }
  return false;
});

$app->put('/api/teachers/{id}/approve', function ($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $updatedTeacher = $teachersDAO->approveTeacher($args['id']);
  $response = $response->write(json_encode($updatedTeacher))
    ->withHeader('Content-Type','application/json');
  if(empty($updatedTeacher)) {
    $response = $response->withStatus(404);
  }
  return $response;
});

$app->delete('/api/teachers/{id}', function ($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $teachersDAO->deleteTeacher($args['id']);
  return $response->write(true)
    ->withHeader('Content-Type','application/json');
});

/* -- Run Slim Framework ----------- */

$app->run();
