
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require('./../var.php');
  class loginModel extends Database{
   

  public function existUser($username, $password){
    $sql = "SELECT usr_id, usr_nombre FROM tbl_usuario WHERE usr_usuario = ? AND usr_contra = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row;
    } else {
      return false;
    }
  }

}

?>
