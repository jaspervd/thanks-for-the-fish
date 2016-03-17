<?php
require_once WWW_ROOT . 'dao/DAO.php';
class TeachersDAO extends DAO {

	public function getTeachers() {
		$sql = "SELECT * FROM `bw_teachers` ORDER BY `id` ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getTeacherById($id) {
    $sql = "SELECT * FROM `bw_teachers` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
    return $result;
  }

  public function insertTeacher($firstname, $lastname, $email, $password, $phone, $school_name, $school_email, $school_address, $school_website) {
    $sql = "INSERT INTO `bw_teachers` (frontname, lastname, email, password, phone, school_name, school_email, school_address, school_website) VALUES (:firstname, :lastname, :email, :password, :phone, :school_name, :school_email, :school_address, :school_website)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':firstname', $firstname);
    $stmt->bindValue(':lastname', $lastname);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':school_name', $school_name);
    $stmt->bindValue(':school_email', $school_email);
    $stmt->bindValue(':school_address', $school_address);
    $stmt->bindValue(':school_website', $school_website);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
    return $result;
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
        return $this->getTeacherById($teacher_id);
      }
    }
    return false;
  }

  public function deleteTeacher($id){
    $qry = "DELETE FROM `bw_teachers` WHERE id = :id";
    $qry->bindValue(':id', $id);
    return $qry->execute();
  }

  public function getValidationErrors($data) {
    $errors = array();
    if(empty($data['firstname'])) {
      $errors['firstname'] = 'Please enter your firstname';
    }
    if(empty($data['lastname'])) {
      $errors['lastname'] = 'Please enter your lastname';
    }
    if(empty($data['email'])) {
      $errors['email'] = 'Please enter your email';
    }
    if(empty($data['password'])) {
      $errors['password'] = 'Please enter your password';
    }
    if(empty($data['phone'])) {
      $errors['phone'] = 'Please enter your phone number';
    }
    return $errors;
  }

}
