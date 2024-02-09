
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('./../var.php');
class loginModel extends Database{



  public function existUser($username, $password){
    $sql = "SELECT usr_id, usr_nombre, usr_contra FROM tbl_usuario WHERE usr_usuario = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $stored_password = $row['usr_contra'];
      if (password_verify($password, $stored_password)) {
        return $row;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }


}

?>
