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

  public function getClassesByTeacherId($id) {
    $sql = "SELECT * FROM `bw_classes` WHERE `creator_id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function insertClass($data) {
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
  }

  public function deleteClass($id) {
    $sql = "DELETE `bw_classes` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }

  public function uploadPhoto($photo) {
    $imageMimeTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($photo['type'], $imageMimeTypes)) {
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
    return false;
  }
}