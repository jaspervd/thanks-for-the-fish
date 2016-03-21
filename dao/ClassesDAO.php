<?php
require_once WWW_ROOT . 'dao/DAO.php';
class ClassesDAO extends DAO {

  //only show classes with reviews in overview
	public function getAuthorizedClasses() {
		$sql = "SELECT `bw_classes`.* FROM `bw_classes`
            WHERE (SELECT COUNT(*) FROM `bw_scores` WHERE `bw_scores`.`class_id` = `bw_classes`.`id`) > :zero_reviews
            ORDER BY `id` ASC";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':zero_reviews', 0);
    $qry->execute();
    $result = $qry->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  //show all classes
  public function getClasses() {
    $sql = "SELECT `bw_classes`.* FROM `bw_classes`
            ORDER BY `id` ASC";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':zero_reviews', 0);
    $qry->execute();
    $result = $qry->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getClassesByTeacherId($teacher_id) {
    $sql = "SELECT * FROM `bw_classes`
            WHERE `creator_id` = :creator_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':creator_id', $teacher_id);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
    return $result;
  }

  public function getClassById($id) {
    $sql = "SELECT * FROM `bw_classes` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    if($stmt->execute()) {
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return array();
  }

  public function insertClass($data) {
    $errors = $this->getValidationErrors($data);
    if(empty($errors)){
      $sql = "INSERT INTO `bw_classes` (creator_id, nickname, num_students, photo, entry) VALUES (:creator_id, :nickname, :num_students, :photo, :entry)";
      $qry = $this->pdo->prepare($sql);
      $qry->bindValue(':creator_id', $data['creator_id']);
      $qry->bindValue(':nickname', $data['nickname']);
      $qry->bindValue(':num_students', $data['num_students']);
      $photo = $this->uploadPhoto($data['photo']);
      $qry->bindValue(':photo', $photo);
      $qry->bindValue(':entry', $data['entry']);
      $qry->execute();
      if($qry->execute()){
        $insertedId = $this->pdo->lastInsertId();
        return $this->getClassById($insertedId);
      }
    }
    return false;
  }

  public function deleteClass($id) {
    $sql = "DELETE FROM `bw_classes` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }

  public function uploadPhoto($photo) {
    $targetFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $photo['name'];
    $pos = strrpos($targetFile, '.');
    $filename = substr($targetFile, 0, $pos);
    $ext = substr($targetFile, $pos + 1);
    $i = 0;
    while (file_exists($targetFile)) {
      $i++;
      $targetFile = $filename . $i . '.' . $ext;
    }
    move_uploaded_file($photo['tmp_name'], $targetFile);
    $photo_url = str_replace(dirname(__DIR__) . DIRECTORY_SEPARATOR, '', $targetFile);
    return $photo_url;
  }

  public function getValidationErrors($data) {
    $errors = array();
    if(empty($data['creator_id'])) {
      $errors['creator'] = 'Only valid teachers can do this';
    }
    if(empty($data['nickname'])) {
      $errors['nickname'] = 'Please enter a class nickname';
    }
    if(empty($data['num_students'])) {
      $errors['num_students'] = 'Please specify how many students are in this class';
    }
    if(empty($data['photo'])) {
      $errors['photo'] = 'Please upload a picture';
    }
    if(empty($data['entry'])) {
      $errors['entry'] = 'Every entry needs... well, an entry';
    }
    return $errors;
  }
}
