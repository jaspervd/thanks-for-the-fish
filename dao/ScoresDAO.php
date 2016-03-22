<?php
require_once WWW_ROOT . 'dao/DAO.php';

class ScoresDAO extends DAO {

	public function getScores() {
    $sql = "SELECT `bw_scores`.*, `bw_classes`.*
            FROM `bw_scores` LEFT JOIN `bw_classes` ON `bw_scores`.`class_id` = `bw_classes`.`id`
            ORDER BY `bw_scores`.`score` DESC";
    $qry = $this->pdo->prepare($sql);
    $qry->execute();
    $result = $qry->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getScoresByClassId($class_id) {
		$sql = "SELECT `bw_scores`.*, `bw_classes`.*
            FROM `bw_scores` LEFT JOIN `bw_classes` ON `bw_scores`.`class_id` = `bw_classes`.`id`
            WHERE `bw_scores`.`class_id` = :class_id
            ORDER BY `bw_scores`.`score` DESC";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':class_id', $class_id);
    $qry->execute();
    $result = $qry->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getScoreByClassIdAndAdminId($class_id, $admin_id) {
    $sql = "SELECT `bw_scores`.* FROM `bw_scores`
            WHERE `bw_scores`.`class_id` = :class_id AND `bw_scores`.`admin_id` = :admin_id";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':class_id', $class_id);
    $qry->bindValue(':admin_id', $admin_id);
    if($qry->execute()){
      $result = $qry->fetch(PDO::FETCH_ASSOC);
      if(!empty($result)){
        return $result['score'];
      }
    }
    return 0;
  }

  public function getScoresByAdminId($admin_id) {
    $sql = "SELECT `bw_scores`.*, `bw_classes`.*
            FROM `bw_scores` LEFT JOIN `bw_classes` ON `bw_scores`.`class_id` = `bw_classes`.`id`
            WHERE `bw_scores`.`admin_id` = :admin_id
            ORDER BY `bw_scores`.`score` DESC";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':admin_id', $admin_id);
    $qry->execute();
    $result = $qry->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getScoreById($id) {
    $sql = "SELECT `bw_scores`.*, `bw_classes`.*
            FROM `bw_scores` LEFT JOIN `bw_classes` ON `bw_scores`.`class_id` = `bw_classes`.`id`
            WHERE `bw_scores`.`id` = :id";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':id', $id);
    $qry->execute();
    $result = $qry->fetch(pdo::FETCH_ASSOC);
    return $result;
  }

  public function insertScore($class_id, $admin_id, $data) {
    $errors = $this->getValidationErrors($data);
    if(empty($errors)){
      $sql = "INSERT INTO `bw_scores` (class_id, admin_id, score)
              VALUES (:class_id, :admin_id, :score)";
      $qry = $this->pdo->prepare($sql);
      $qry->bindValue(':class_id', $class_id);
      $qry->bindValue(':admin_id', $admin_id);
      $qry->bindValue(':score', $data['score']);
      if($qry->execute()){
        $insertedId = $this->pdo->lastInsertId();
        $score = $this->getScoreById($insertedId);
        return $score;
      }
    }
    return false;
  }

  public function updateScore($class_id, $admin_id, $data){
    $errors = $this->getValidationErrors($data);
    if(empty($errors)){
      $sql = "UPDATE `bw_scores` SET `score` = :score
              WHERE `class_id` = :class_id AND `admin_id` = :admin_id";
      $qry = $this->pdo->prepare($sql);
      $qry->bindValue(':score', $data['score']);
      $qry->bindValue(':class_id', $class_id);
      $qry->bindValue(':admin_id', $admin_id);
      if($qry->execute()){
        return $this->getScoreByClassIdAndAdminId($class_id, $admin_id);
      }
    }
    return $errors;
  }

  public function getValidationErrors($data) {
    $errors = array();

    if(empty($data['score']) || $data['score'] < 0 || $data['score'] > 10){
      $errors['score'] = "Please provide a score between 0 and 10.";
    }

    return $errors;
  }

}
