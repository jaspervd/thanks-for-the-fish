<?php
require_once WWW_ROOT . 'dao/DAO.php';
class TeachersDAO extends DAO {

	public function getTeachers() {
		$sql = "SELECT * FROM `bw_teachers`
            ORDER BY `id` ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':authorized', 1);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for($i=0; $i<count($result); $i++){
      unset($result[$i]['password']);
    }
    return $result;
  }

  public function getTeacherById($id) {
    $sql = "SELECT * FROM `bw_teachers`
            WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
    return $result;
  }

  public function login($email, $password){
    $sql = "SELECT * FROM `bw_teachers`
            WHERE `email` = :email AND `authorized` = :authorized";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':email', $email);
    $qry->bindValue(':authorized', 1);
    $qry->execute();
    $user = $qry->fetch(pdo::FETCH_ASSOC);
    if(!empty($user)){
      if(password_verify($password, $user['password'])){
        return $user;
      }
    }
    return false;
  }

  public function insertTeacher($data) {
    $errors = $this->getValidationErrors($data);
    if(empty($errors)){
      $sql = "INSERT INTO `bw_teachers` (firstname, lastname, email, password, phone, school_name, school_email, school_address, school_website) VALUES (:firstname, :lastname, :email, :password, :phone, :school_name, :school_email, :school_address, :school_website)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':firstname', $data['firstname']);
      $stmt->bindValue(':lastname', $data['lastname']);
      $stmt->bindValue(':email', $data['email']);
      $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_BCRYPT));
      $stmt->bindValue(':phone', $data['phone']);
      $stmt->bindValue(':school_name', $data['school_name']);
      $stmt->bindValue(':school_email', $data['school_email']);
      $stmt->bindValue(':school_address', $data['school_address']);
      $stmt->bindValue(':school_website', $data['school_website']);
      if($stmt->execute()){
        $insertedId = $this->pdo->lastInsertId();
        return $this->getTeacherById($insertedId);
      }
    }
    return false;
  }

  public function approveTeacher($id){
    $teacher = $this->getTeacherById($id);
    $errors = $this->getValidationErrors($teacher);
    if(empty($errors)){
      $sql = "UPDATE `bw_teachers` SET `authorized` = :authorized WHERE `id` = :id";
      $qry = $this->pdo->prepare($sql);
      $qry->bindValue(':id', $id);
      $qry->bindValue(':authorized', 1);
      if($qry->execute()){
        return $this->getTeacherById($id);
      }
    }
    return false;
  }

  public function deleteTeacher($id){
    $sql = "DELETE FROM `bw_teachers` WHERE id = :id";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':id', $id);
    return $qry->execute();
  }

  public function getValidationErrors($data) {
    $errors = array();
    if(empty($data['firstname'])) {
      $errors['firstname'] = 'Gelieve je voornaam in te vullen';
    }
    if(empty($data['lastname'])) {
      $errors['lastname'] = 'Gelieve je achternaam in te vullen';
    }
    if(empty($data['email'])) {
      $errors['email'] = 'Gelieve je e-mailadres in te vullen';
    }
    if(empty($data['password'])) {
      $errors['password'] = 'Gelieve je wachtwoord in te vullen';
    }
    if(empty($data['phone'])) {
      $errors['phone'] = 'Gelieve je telefoonnummer in te vullen';
    }
    return $errors;
  }

}
