<?php
require_once WWW_ROOT . 'dao/DAO.php';
class ClassesDAO extends DAO {
	public function getClasses() {
		$sql = "SELECT * FROM `bw_classes` ORDER BY `id` ASC";
    $stmt = $this->pdo->prepare($sql);
    if($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return array();
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

  public function getClassesByTeacherId($id) {
    $sql = "SELECT * FROM `bw_classes` WHERE `creator_id` = :id";
    $stmt = $this->pdo->prepare($sql);
    if($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return array();
  }

  public function insertClass($data) {
    $errors = $this->getValidationErrors($data);
    if(empty($errors)) {
      $sql = "INSERT INTO `bw_classes` (creator_id, nickname, num_students, photo, entry) VALUES (:creator_id, :nickname, :num_students, :photo, :entry)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':creator_id', $data['creator_id']);
      $stmt->bindValue(':nickname', $data['nickname']);
      $stmt->bindValue(':num_students', $data['num_students']);
      $photo = $this->uploadPhoto($data['photo']);
      $stmt->bindValue(':photo', $photo);
      $stmt->bindValue(':entry', $data['entry']);
      if($stmt->execute()){
        $insertedId = $this->pdo->lastInsertId();
        return $this->getClassById($insertedId);
      }
      return $result;
    } else {
      return $errors;
    }
    return false;
  }

  public function getValidationErrors($data) {
    $errors = array();

    if(empty($data['nickname'])) {
      $errors['score'] = "Please enter a nickname.";
    }

    if(empty($data['num_students']) || is_nan($data['num_students']) || $data['num_students'] < 0) {
      $errors['score'] = "Please enter a valid number of students.";
    }

    $imageMimeTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (empty($data['photo']) || !in_array($data['photo']['type'], $imageMimeTypes)) {
      $errors['photo'] = "Please upload a valid photo.";
    }

    if(empty($data['entry'])) {
      $errors['entry'] = "Please type your book review.";
    }

    return $errors;
  }

  public function deleteClass($id) {
    $sql = "DELETE `bw_classes` WHERE `id` = :id";
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
}