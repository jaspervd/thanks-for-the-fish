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
}