<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

require 'vendor/autoload.php';
require 'dao/TeachersDAO.php';
require 'dao/AdminsDAO.php';
require 'dao/ScoresDAO.php';

$app = new \Slim\App;
$teachersDAO = new TeachersDAO();

/* -- Front End : Pagination ------------------ */

$app->get('/', function($request, $response, $args) {
	$view = new \Slim\Views\PhpRenderer('view/');
	$basePath = $request->getUri()->getBasePath();
	return $view->render($response, 'home.php', ['basePath' => $basePath]);
});

/* -- API: Teachers -------------- */

$app->get('/api/teachers', function() use ($teachersDAO) {
    header('Content-Type: application/json');
    $teachers = $teachersDAO->getTeachers();
    for($i=0; $i<count($teachers); $i++){
      unset($teachers[$i]['password']);
    }
    echo json_encode($teachersDAO->getTeachers());
    exit;
});

$app->get('/api/teachers/{id}', function($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $teacher = $teachersDAO->getTeacherById($args['id']);
  unset($teacher['password']);
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
  unset($insertedTeacher['password']);
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
    unset($teacher['password']);
    $_SESSION['user'] = $teacher;
  }
  return $response;
});

$app->get('/api/user/{data}', function ($request, $response, $args) {
  session_start();
  if(!empty($_SESSION) && !empty($_SESSION['user']) && $args['data'] != "password"){
    return "".$_SESSION['user'][$args['data']];
  }
  return false;
});

$app->put('/api/teachers/{id}/approve', function ($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $updatedTeacher = $teachersDAO->approveTeacher($args['id']);
  unset($updatedTeacher['password']);
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

/* -- API: Admins ------------------ */

$app->get('/api/admins', function ($request, $response, $args) {
  $adminsDAO = new AdminsDAO();
  $admins = $adminsDAO->getAdmins();
  for($i=0; $i<count($admins); $i++){
    unset($admins[$i]['password']);
    unset($admins[$i]['role_id']);
  }
  return $response->write(json_encode($admins))
    ->withHeader('Content-Type','application/json');
});

$app->get('/api/admins/{id}', function($request, $response, $args) {
  $adminsDAO = new AdminsDAO();
  $admin = $adminsDAO->getAdminById($args['id']);
  unset($admin['password']);
  unset($admin['role_id']);
  $response = $response->write(json_encode($admin))
    ->withHeader('Content-Type','application/json');
  if(empty($admin)) {
    $response = $response->withStatus(404);
  }
  return $response;
});

$app->post('/api/admins', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_create_admins');
  if($authorized){
    $newAdmin = $request->getParsedBody();
    $insertedAdmin = $adminsDAO->insertAdmin($newAdmin);
    unset($insertedAdmin['password']);
    $response = $response->write(json_encode($insertedAdmin))
      ->withHeader('Content-Type','application/json');
    if(empty($insertedAdmin)) {
      $response = $response->withStatus(404);
    } else {
      $response = $response->withStatus(201);
    }
    return $response;
  }
  return $response->withStatus(401);
});

$app->post('/api/admin/auth', function ($request, $response, $args) {
  $adminsDAO = new AdminsDAO();
  $loginData = $request->getParsedBody();
  $admin = $adminsDAO->login($loginData['entry'], $loginData['password']);
  $response = $response->write(json_encode($admin))
    ->withHeader('Content-Type','application/json');
  if(empty($admin)) {
    $response = $response->withStatus(404);
  }else{
    session_start();
    unset($admin['password']);
    $_SESSION['admin'] = $admin;
  }
  return $response;
});

$app->get('/api/admin/{data}', function ($request, $response, $args) {
  session_start();
  if(!empty($_SESSION) && !empty($_SESSION['admin']) && $args['data'] != "password"){
    return "".$_SESSION['admin'][$args['data']];
  }
  return false;
});

$app->put('/api/admins/{id}', function ($request, $response, $args) {
  $adminsDAO = new AdminsDAO();
  $updateData = $request->getParsedBody();
  $updatedAdmin = $adminsDAO->updateAdmin($args['id'], $updateData);
  unset($updatedAdmin['password']);
  $response = $response->write(json_encode($updatedAdmin))
    ->withHeader('Content-Type','application/json');
  if(empty($updatedAdmin)) {
    $response = $response->withStatus(404);
  }
  return $response;
});

$app->delete('/api/admins/{id}', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_create_admins');
  if($authorized){
    $adminsDAO = new AdminsDAO();
    $adminsDAO->deleteAdmin($args['id']);
    return $response->write(true)
      ->withHeader('Content-Type','application/json');
  }
  return $response->withStatus(401);
});

/* -- API: Scores ------------------ */

$app->get('/api/scores', function ($request, $response, $args) {
  $scoresDAO = new ScoresDAO();
  $scores = $scoresDAO->getScores();
  return $response->write(json_encode($scores))
    ->withHeader('Content-Type','application/json');
});

/* -- Helper Functions ----------- */

function checkAdminPrivilege($privilegeToCheck){
  if(!empty($_SESSION) && !empty($_SESSION['admin']['id'])){
    $adminsDAO = new AdminsDAO();
    $userAdmin = $adminsDAO->getAdminById($_SESSION['admin']['id']);
    if(!empty($userAdmin) && $userAdmin[$privilegeToCheck] == 1){
      return true;
    }
  }
  return false;
}

$app->run();
