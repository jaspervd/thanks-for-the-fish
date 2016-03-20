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

  public function insertClass($creator_id, $nickname, $num_students, $photo, $entry) {
    $sql = "INSERT INTO `bw_classes` (creator_id, nickname, num_students, photo, entry) VALUES (:creator_id, :nickname, :num_students, :photo, :entry)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':creator_id', $creator_id);
    $stmt->bindValue(':nickname', $nickname);
    $stmt->bindValue(':num_students', $num_students);
    $photo = $this->uploadPhoto($photo['files'][0]);
    $stmt->bindValue(':photo', $photo);
    $stmt->bindValue(':entry', $entry);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
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
      $targetFile = __DIR__ . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $photo['name'];
      $pos = strrpos($targetFile, '.');
      $filename = substr($targetFile, 0, $pos);
      $ext = substr($targetFile, $pos + 1);
      $i = 0;
      while (file_exists($targetFile)) {
        $i++;
        $targetFile = $filename . $i . '.' . $ext;
      }
      move_uploaded_file($photo['tmp_name'], $targetFile);
      $photo_url = str_replace(WWW_ROOT, '', $targetFile);
      return $photo_url;
    }
    return false;
  }
}