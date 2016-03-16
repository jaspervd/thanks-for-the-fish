<?php
require_once WWW_ROOT . 'dao/DAO.php';
class ClassesDAO extends DAO {
	public function getClasses() {
		$sql = "SELECT * FROM `bw_classes` ORDER BY `id` ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getClassById($id) {
    $sql = "SELECT * FROM `bw_classes` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
    return $result;
  }

  public function insertClass($creator_id, $nickname, $num_students, $photo, $entry) {
    $sql = "INSERT INTO `bw_classes` (creator_id, nickname, num_students, photo, entry) VALUES (:creator_id, :nickname, :num_students, :photo, :entry)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':creator_id', $creator_id);
    $stmt->bindValue(':nickname', $nickname);
    $stmt->bindValue(':num_students', $num_students);
    $stmt->bindValue(':photo', $photo);
    $stmt->bindValue(':entry', $entry);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
    return $result;
  }

  public function deleteClass($id) {
    $sql = "DELETE `bw_teachers` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }
}