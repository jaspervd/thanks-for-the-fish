<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

require 'vendor/autoload.php';
require 'dao/TeachersDAO.php';
require 'dao/AdminsDAO.php';
require 'dao/ScoresDAO.php';
require 'dao/ClassesDAO.php';

$app = new \Slim\App;

/* -- Front End : Pagination --------------------------------------------- */

$app->get('/', function($request, $response, $args) {
	$view = new \Slim\Views\PhpRenderer('view/');
	$basePath = $request->getUri()->getBasePath();
	return $view->render($response, 'home.php', ['basePath' => $basePath, 'teacher' => (checkLoggedIn('user')? $_SESSION['user'] : array())]);
});

$app->get('/login', function($request, $response, $args) {
  $basePath = $request->getUri()->getBasePath();
  if(!checkLoggedIn('user')) {
    $view = new \Slim\Views\PhpRenderer('view/');
    return $view->render($response, 'login.php', ['basePath' => $basePath]);
  } else {
    header('Location: '. $basePath .'/klas');
    exit;
  }
});

$app->get('/klas', function($request, $response, $args) {
  $basePath = $request->getUri()->getBasePath();
  if(checkLoggedIn('user')) {
    $view = new \Slim\Views\PhpRenderer('view/');
    return $view->render($response, 'class.php', ['basePath' => $basePath, 'teacher' => $_SESSION['user']]);
  } else {
    header('Location: '. $basePath .'/login');
    exit;
  }
});

/* -- Back End : Authentication --------------------------------------------- */

$app->get('/admin[/{anything:.*}]', function($request, $response, $args) {
  $basePath = $request->getUri()->getBasePath();
  if(checkLoggedIn('admin')) {
    $view = new \Slim\Views\PhpRenderer('view/');
    return $view->render($response, 'admin.php', ['basePath' => $basePath, 'admin' => $_SESSION['admin']]);
  } else {
    header('Location: '. $basePath .'/admin-login');
    exit;
  }/**/
});

$app->get('/admin-login', function($request, $response, $args) {
  $basePath = $request->getUri()->getBasePath();
  $view = new \Slim\Views\PhpRenderer('view/');
  return $view->render($response, 'adminLogin.php', ['basePath' => $basePath]);
});

/* -- API: Teachers ------------------------------------------------------ */

//overview of all registered and authorized teachers, only available to logged in admins
$app->get('/api/teachers', function ($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
    $teachersDAO = new TeachersDAO();
    $teachers = $teachersDAO->getTeachers();
    for($i=0; $i<count($teachers); $i++){
      unset($teachers[$i]['password']);
    }
    return $response->write(json_encode($teachers))
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

//data of a specific teacher
$app->get('/api/teachers/{id}', function($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $teacher = $teachersDAO->getTeacherById($args['id']);
  unset($teacher['password']);
  $response = $response->write(json_encode($teacher))
  ->withHeader('Content-Type','application/json');
  if(empty($teacher)) {
    $response = $response->withStatus(404);
  }
  return $response;
});

//register as a teacher
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

//login as a teacher, only available to teachers who have registered and been authorized by an admin
$app->post('/api/teachers/auth', function ($request, $response, $args) {
  $teachersDAO = new TeachersDAO();
  $loginData = $request->getParsedBody();
  $teacher = $teachersDAO->login($loginData['email'], $loginData['password']);
  unset($teacher['password']);
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

//return session data for logged in teacher
$app->get('/api/user/{data}', function ($request, $response, $args) {
  session_start();
  if(!empty($_SESSION) && !empty($_SESSION['user']) && $args['data'] != "password"){
    return "".$_SESSION['user'][$args['data']];
  }
  return false;
});

//logout teacher by deleting session data
$app->get('/api/teacher/auth/logout', function ($request, $response, $args) {
  if(checkLoggedIn('user')){
    unset($_SESSION['user']);
  }
});

//approve a teacher, only available to admins of the 'admin' type
$app->put('/api/teachers/{id}/approve', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_authorize_teachers');
  if($authorized){
    $teachersDAO = new TeachersDAO();
    $updatedTeacher = $teachersDAO->approveTeacher($args['id']);
    unset($updatedTeacher['password']);
    $response = $response->write(json_encode($updatedTeacher))
    ->withHeader('Content-Type','application/json');
    if(empty($updatedTeacher)) {
      $response = $response->withStatus(404);
    }
    return $response;
  }
  $response = $response->withStatus(401);
  return $response;
});

//delete a teacher, only available to admins of the 'admin' type
$app->delete('/api/teachers/{id}', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_authorize_teachers');
  if($authorized){
    $teachersDAO = new TeachersDAO();
    $teachersDAO->deleteTeacher($args['id']);
    return $response->write(true)
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

/* -- API: Classes ------------------------------------------------------ */

//overview of all approved entries/classes
$app->get('/api/classes/authorized', function ($request, $response, $args) {
  $classesDAO = new ClassesDAO();
  $classes = $classesDAO->getAuthorizedClasses();
  return $response->write(json_encode($classes))
  ->withHeader('Content-Type','application/json');
});

//overview of all entries/classes
$app->get('/api/classes', function ($request, $response, $args) {
  $classesDAO = new ClassesDAO();
  $classes = $classesDAO->getClasses();
  return $response->write(json_encode($classes))
  ->withHeader('Content-Type','application/json');
  $response = $response->withStatus(401);
  return $response;
});

//data of specific entry/class
$app->get('/api/classes/{id}', function ($request, $response, $args) {
  $classesDAO = new ClassesDAO();
  $class = $classesDAO->getClassById($args['id']);
  return $response->write(json_encode($class))
  ->withHeader('Content-Type','application/json');
});

//overview of all classes entered by a specific teacher, only visible to logged in teachers (=users)
$app->get('/api/teachers/{teacher_id}/classes', function ($request, $response, $args) {
  $authorized = checkLoggedIn('user');
  if($authorized){
    $classesDAO = new ClassesDAO();
    $classes = $classesDAO->getClassesByTeacherId($args['teacher_id']);
    return $response->write(json_encode($classes))
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

//enter a class, only available to logged in teachers
$app->post('/api/classes', function ($request, $response, $args) {
  $authorized = checkLoggedIn('user');
  if($authorized){
    $classesDAO = new ClassesDAO();
    $newClass = $request->getParsedBody();
    $newClass['creator_id'] = $_SESSION['user']['id'];
    $newClass = array_merge($newClass, $_FILES);
    $insertedClass = $classesDAO->insertClass($newClass);
    $response = $response->write(json_encode($insertedClass))
    ->withHeader('Content-Type','application/json');
    if(empty($insertedClass)) {
      $response = $response->withStatus(404);
    } else {
      $response = $response->withStatus(201);
    }
    return $response;
  }
  $response = $response->withStatus(401);
  return $response;
});

//delete a class, only abailable to logged in teachers
$app->delete('/api/classes/{id}', function ($request, $response, $args) {
  $authorized = checkLoggedIn('user');
  if($authorized){
    $classesDAO = new ClassesDAO();
    $classesDAO->deleteClass($args['id']);
    return $response->write(true)
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

/* -- API: Admins ---------------------------------------------------------- */

//overview of all admins, only visible for logged in admins
$app->get('/api/admins', function ($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
    $adminsDAO = new AdminsDAO();
    $admins = $adminsDAO->getAdmins();
    for($i=0; $i<count($admins); $i++){
      unset($admins[$i]['password']);
      unset($admins[$i]['role_id']);
    }
    return $response->write(json_encode($admins))
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

//data of specific admin, only visible for logged in admins
$app->get('/api/admins/{id}', function($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
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
  }
  $response = $response->withStatus(401);
  return $response;
});

//add a new admin account (+send notification email), only available for admins of the 'admin' type
$app->post('/api/admins', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_create_admins');
  if($authorized){
    $adminsDAO = new AdminsDAO();
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
  }
  $response = $response->withStatus(401);
  return $response;
});

//check if admin is logged in
$app->get('/api/admin/auth', function ($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
    $response = $response->write(true)
    ->withHeader('Content-Type','application/json');
  }else{
    $response = $response->withStatus(401);
  }
  return $response;
});

//get all admin session data
$app->get('/api/admin', function ($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
    $response = $response->write(json_encode($_SESSION['admin']))
    ->withHeader('Content-Type','application/json');
  }else{
    $response = $response->withStatus(401);
  }
  return $response;
});

//check if admin has a certain privilege
$app->get('/api/admin/privilege/{privilege_to_check}', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege($args['privilege_to_check']);
  if($authorized){
    $response = $response->write(true)
    ->withHeader('Content-Type','application/json');
  }else{
    $response = $response->withStatus(401);
  }
  return $response;
});

//log in admin and start admin session
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

//return session data for logged in admin
$app->get('/api/admin/{data}', function ($request, $response, $args) {
  session_start();
  if(!empty($_SESSION) && !empty($_SESSION['admin']) && $args['data'] != "password"){
    return "".$_SESSION['admin'][$args['data']];
  }
  return false;
});

//logout admin by deleting session data
$app->get('/api/admin/auth/logout', function ($request, $response, $args) {
  $basePath = $request->getUri()->getBasePath();
  if(checkLoggedIn('admin')){
    unset($_SESSION['admin']);
  }
  header('Location: '. $basePath .'/admin-login');
  exit;
});

//update admin data, only available for logged in admins
$app->put('/api/admins/{id}', function ($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
    $adminsDAO = new AdminsDAO();
    $updateData = $request->getParsedBody();
    $updatedAdmin = $adminsDAO->updateAdmin($args['id'], $updateData);
    unset($updatedAdmin['password']);
    $response = $response->write(json_encode($updatedAdmin))
    ->withHeader('Content-Type','application/json');
    if(empty($updatedAdmin)) {
      $response = $response->withStatus(404);
    }else{
      session_start();
      unset($updatedAdmin['password']);
      $_SESSION['admin'] = $updatedAdmin;
    }
    return $response;
  }
  $response = $response->withStatus(401);
  return $response;
});

//delete an admin, only available for admins of the 'admin' type
$app->delete('/api/admins/{id}', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_create_admins');
  if($authorized){
    $adminsDAO = new AdminsDAO();
    $adminsDAO->deleteAdmin($args['id']);
    return $response->write(true)
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

/* -- API: Scores ---------------------------------------------------------- */

//overview of all scores
$app->get('/api/scores', function ($request, $response, $args) {
  $scoresDAO = new ScoresDAO();
  $scores = $scoresDAO->getScores();
  return $response->write(json_encode($scores))
  ->withHeader('Content-Type','application/json');
});

//overview of scores for a specific class entry
$app->get('/api/classes/{class_id}/scores', function ($request, $response, $args) {
  $scoresDAO = new ScoresDAO();
  $scores = $scoresDAO->getScoresByClassId($args['class_id']);
  return $response->write(json_encode($scores))
  ->withHeader('Content-Type','application/json');
});

$app->get('/api/classes/{class_id}/myscore', function ($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
    $scoresDAO = new ScoresDAO();
    $score = $scoresDAO->getScoreByClassIdAndAdminId($args['class_id'], $_SESSION['admin']['id']);
    return $response->write(json_encode($score))
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

//overview of scores done by a specific admin, only visible for logged in admins
$app->get('/api/scores/by/{admin_id}', function ($request, $response, $args) {
  $authorized = checkLoggedIn('admin');
  if($authorized){
    $scoresDAO = new ScoresDAO();
    $scores = $scoresDAO->getScoresByAdminId($args['admin_id']);
    return $response->write(json_encode($scores))
    ->withHeader('Content-Type','application/json');
  }
  $response = $response->withStatus(401);
  return $response;
});

//add a new score, only available for admins of the 'jury' type
$app->post('/api/classes/{class_id}/scores', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_vote_winner');
  if($authorized){
    $scoresDAO = new ScoresDAO();
    $scoreData = $request->getParsedBody();
    $existingScore = $scoresDAO->getScoreByClassIdAndAdminId($args['class_id'], $_SESSION['admin']['id']);
    if($existingScore == 0){
      $newScore = $scoresDAO->insertScore($args['class_id'], $_SESSION['admin']['id'], $scoreData);
    }else{
      $newScore = $scoresDAO->updateScore($args['class_id'], $_SESSION['admin']['id'], $scoreData);
    }
    $response = $response->write(json_encode($newScore))
    ->withHeader('Content-Type','application/json');
    if(empty($newScore)) {
      $response = $response->withStatus(404);
    } else {
      $response = $response->withStatus(201);
    }
    return $response;
  }
  $response = $response->withStatus(401);
  return $response;
});

//change an already given score, only available for the jury member who gave the score
$app->put('/api/classes/{class_id}/scores', function ($request, $response, $args) {
  $authorized = checkAdminPrivilege('can_vote_winner');
  if($authorized){
    $scoresDAO = new ScoresDAO();
    $updateData = $request->getParsedBody();
    return $updateData;
    $updatedScore = $scoresDAO->updateScore($args['class_id'], $_SESSION['admin']['id'], $updateData);
    $response = $response->write(json_encode($updatedScore))
    ->withHeader('Content-Type','application/json');
    if(empty($updatedScore)) {
      $response = $response->withStatus(404);
    }
    return $response;
  }
  $response = $response->withStatus(401);
  return $response;
});

/* -- Helper Functions --------------------------------------------------- */

//Check if the user (teacher or admin) in the session is legit
function checkLoggedIn($typeToCheck){
  session_start();
  //check if sessiondata exists
  if(!empty($_SESSION) && !empty($_SESSION[$typeToCheck]['id'])){
    $currentUser = [];
    //check for database entry based on session's user id
    if($typeToCheck == 'admin'){
      $adminsDAO = new AdminsDAO();
      $currentUser = $adminsDAO->getAdminById($_SESSION['admin']['id']);
    }else{
      $teachersDAO = new TeachersDAO();
      $currentUser = $teachersDAO->getTeacherById($_SESSION['user']['id']);
      if($currentUser['authorized'] == 0){ return false; } //teachers not yet authorized by admin can't edit database
    }
    //if a database entry exists, logged in user is trustworthy
    if(!empty($currentUser)){
      return true;
    }
  }
  return false;
}

//Not all admins have the same rights (admins = all privileges, jury = limited)
function checkAdminPrivilege($privilegeToCheck){
  session_start();
  //look for admin session data
  if(!empty($_SESSION) && !empty($_SESSION['admin']['id'])){
    //check for database entry based on session's admin id
    $adminsDAO = new AdminsDAO();
    $userAdmin = $adminsDAO->getAdminById($_SESSION['admin']['id']);
    //check if the admin in the db has the right privileges
    if(!empty($userAdmin) && $userAdmin[$privilegeToCheck] == 1){
      return true;
    }
  }
  return false;
}

$app->run();
