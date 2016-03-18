<?php
require_once WWW_ROOT . 'dao/DAO.php';
class AdminsDAO extends DAO {

	public function getAdmins() {
		$sql = "SELECT `bw_admins`.*, `bw_admin_roles`.*
            FROM `bw_admins`LEFT JOIN `bw_admin_roles` ON `bw_admins`.`role_id` = `bw_admin_roles`.`id`
            ORDER BY `bw_admins`.`id` ASC";
    $qry = $this->pdo->prepare($sql);
    $qry->execute();
    $result = $qry->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getAdminById($id) {
    $sql = "SELECT `bw_admins`.*, `bw_admin_roles`.*
            FROM `bw_admins`LEFT JOIN `bw_admin_roles` ON `bw_admins`.`role_id` = `bw_admin_roles`.`id`
            WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(pdo::FETCH_ASSOC);
    return $result;
  }

  public function login($entry, $password){
    $sql = "SELECT `bw_admins`.*, `bw_admin_roles`.*
            FROM `bw_admins`LEFT JOIN `bw_admin_roles` ON `bw_admins`.`role_id` = `bw_admin_roles`.`id`
            WHERE `username` = :entry OR `email` = :entry";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':entry', $entry);
    $qry->execute();
    $admin = $qry->fetch(pdo::FETCH_ASSOC);
    if(!empty($admin)){
      if(password_verify($password, $admin['password'])){
        return $admin;
      }
    }
    return false;
  }

  public function insertAdmin($data) {
    $errors = $this->getValidationErrors($data);
    if(empty($errors)){
      $sql = "INSERT INTO `bw_admins` (username, email, password, role_id)
              VALUES (:username, :email, :password, :role_id)";
      $qry = $this->pdo->prepare($sql);
      $qry->bindValue(':username', $data['username']);
      $qry->bindValue(':email', $data['email']);
      $qry->bindValue(':password', password_hash($data['password'], PASSWORD_BCRYPT));
      $qry->bindValue(':role_id', $data['role_id']);
      if($qry->execute()){
        $insertedId = $this->pdo->lastInsertId();
        $admin = $this->getAdminById($insertedId);
        $this->sendNotificationEmail($admin);
        return $admin;
      }
    }
    return false;
  }

  public function sendNotificationEmail($admin){
    $to = $admin['email'];
    $from = "notifications@admins.boek.be";
    $subject = "Jury Account Toegevoegd";

    $headers = "MIME-Version: 1.0\r\n";
    $date = date('D, d\t\h M Y h:i:s O');
    $headers .= "Date: {$date}\r\n";
    $headers .= "From: {$from}\r\n";
    $headers .= "Reply-To: {$from}\r\n";
    $headers .= "Subject: {$subject}\r\n";
    $headers .= "X-Sender: {$from}\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if($admin['role_id'] == 1){
      $message = "<html>\r\n";
      $message .= "<body>\r\n";
      $message .= " <h2>Een nieuwe Admin account voor 'Klassieker in je Klas' is voor u aangemaakt</h2>";
      $message .= " <p>-------------------------------</p>";
      $message .= " <h1>Gelieve in te loggen op \"http://klassiekers.boek.be/admin\" met volgende inlog data:</h1>";
      $message .= " <p>Username: \"{$admin['username']}\" (of uw e-mail adres)</p>\r\n";
      $message .= " <p>Password: \"boek_admin\"</p>\r\n";
      $message .= " <p>-------------------------------</p>";
      $message .= " <p>Na het aanmelden zal u in staat zijn nieuwe admin en jury accounts toe te voegen, alsook geregistreerde leerkracht accounts goed te keuren.</p>";
      $message .= " <p>(Het is aangeraden om na uw eerste keer in te loggen uw paswoord te veranderen)</p>";
      $message .= "</body>\r\n";
      $message .= "</html>\r\n";
    }else{
      $message = "<html>\r\n";
      $message .= "<body>\r\n";
      $message .= " <h2>Een nieuwe Jury account voor 'Klassieker in je Klas' is voor u aangemaakt</h2>";
      $message .= " <p>-------------------------------</p>";
      $message .= " <h1>Gelieve in te loggen op \"http://klassiekers.boek.be/admin\" met volgende inlog data:</h1>";
      $message .= " <p>Username: \"{$admin['username']}\" (of uw e-mail adres)</p>\r\n";
      $message .= " <p>Password: \"klassieker_jury\"</p>\r\n";
      $message .= " <p>-------------------------------</p>";
      $message .= " <p>Na het aanmelden zal u ingediende boekbesprekingen kunnen goedkeuren en stemmen voor de winnaar</p>";
      $message .= " <p>(Het is aangeraden om na uw eerste keer in te loggen uw paswoord te veranderen)</p>";
      $message .= "</body>\r\n";
      $message .= "</html>\r\n";
    }
    mail($to, $subject, $message, $headers);
  }

  public function updateAdmin($data){
    $errors = $this->getValidationErrors($data);
    if(empty($errors)){
      $sql = "UPDATE `bw_admins` SET `username` = :username, `email` = :email, `password` = :password
              WHERE `id` = :id";
      $qry = $this->pdo->prepare($sql);
      $qry->bindValue(':id', $data['id']);
      $qry->bindValue(':username', $data['username']);
      $qry->bindValue(':email', $data['email']);
      $qry->bindValue(':password', $data['password']);
      if($qry->execute()){
        return $this->getAdminById($data['id']);
      }
    }
    return false;
  }

  public function deleteAdmin($id){
    $sql = "DELETE FROM `bw_admins` WHERE id = :id";
    $qry = $this->pdo->prepare($sql);
    $qry->bindValue(':id', $id);
    return $qry->execute();
  }

  public function getValidationErrors($data) {
    $errors = array();
    if(empty($data['username'])) {
      $errors['firstname'] = 'Please enter your firstname';
    }
    if(empty($data['email'])) {
      $errors['email'] = 'Please enter your email';
    }
    if(empty($data['password'])) {
      $errors['password'] = 'Please enter your password';
    }
    if(empty($data['role_id'])) {
      $errors['role_id'] = 'Please choose whether this is a jury or admin account';
    }
    return $errors;
  }

}
